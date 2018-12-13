<?php

namespace App\Http\Controllers;

use App\Classes\ImageHandler;
use App\Customer;
use App\Delivery;
use App\Order;
use App\Result;
use App\Status;
use App\Subject;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const ORDERS_ON_PAGE = 10;
    const SUBJECTS_UPLOAD_DIRECTORY = 'subjects';
    const RESULTS_UPLOAD_DIRECTORY = 'results';
    const IMAGE_WIDTH = 616;

    private $order;

    public function index()
    {
        $data = Order::orderBy('delivery_at', 'desc')->paginate(self::ORDERS_ON_PAGE);
        return view('orders.index', ['orders' => $data]);
    }

    public function create()
    {
        $data = array(
            'customers' => Customer::orderBy('id', 'desc')->get(),
            'deliveries' => Delivery::all()->sortBy('id'),
            'statuses' => Status::all()->sortBy('id'),
        );
        return view('orders.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id',
            'price' => 'required|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'prepayment' => 'required|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'finished_at' => 'required|date',
            'delivery_id' => 'required|exists:deliveries,id',
            'delivery_at' => 'required|date',
            'info' => 'nullable|max:1000',
            'is_need_cake' => 'required|boolean',
            'subject' => 'nullable|max:1000',
            'result' => 'nullable|max:1000',
            'is_in_catalog' => 'required|boolean',
            'status_id' => 'required|exists:statuses,id',
            'subject_photo.*' => 'image|mimes:jpeg,jpg,png',
            'result_photo.*' => 'image|mimes:jpeg,jpg,png',
        ]);

        $this->order = Order::storeOrder([
            'customer_id' => $request->customer_id,
            'price' => $request->price,
            'prepayment' => $request->prepayment,
            'finished_at' => $request->finished_at,
            'delivery_id' => $request->delivery_id,
            'delivery_at' => $request->delivery_at,
            'info' => $request->info,
            'is_need_cake' => $request->is_need_cake,
            'subject' => $request->subject,
            'result' => $request->result,
            'is_in_catalog' => $request->is_in_catalog,
            'status_id' => $request->status_id,
        ]);

        if ($request->hasFile('subject_photo')) {
            foreach ($request->file('subject_photo') as $file) {
                Subject::storeSubject([
                    'order_id' => $this->order->id,
                    'src' => ImageHandler::saveImage(
                        $file,
                        md5(microtime()),
                        self::SUBJECTS_UPLOAD_DIRECTORY . '/' . $this->order->id,
                        self::IMAGE_WIDTH
                    ),
                ]);
            }
        }

        if ($request->hasFile('result_photo')) {
            foreach ($request->file('result_photo') as $file) {
                Result::storeResult([
                    'order_id' => $this->order->id,
                    'src' => ImageHandler::saveImage(
                        $file,
                        md5(microtime()),
                        self::RESULTS_UPLOAD_DIRECTORY . '/' . $this->order->id,
                        self::IMAGE_WIDTH
                    ),
                ]);
            }
        }

        return redirect()->route('orders.index');
    }

    public function edit($id)
    {
        $data = array(
            'order' => Order::find($id),
            'customers' => Customer::orderBy('id', 'desc')->get(),
            'deliveries' => Delivery::all()->sortBy('id'),
            'statuses' => Status::all()->sortBy('id'),
        );
        return view('orders.edit', $data);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id',
            'price' => 'required|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'prepayment' => 'required|regex:/^\d{0,6}(\.\d{1,2})?$/',
            'finished_at' => 'required|date',
            'delivery_id' => 'required|exists:deliveries,id',
            'delivery_at' => 'required|date',
            'info' => 'nullable|max:1000',
            'is_need_cake' => 'required|boolean',
            'subject' => 'nullable|max:1000',
            'result' => 'nullable|max:1000',
            'is_in_catalog' => 'required|boolean',
            'status_id' => 'required|exists:statuses,id',
            'subject_photo.*' => 'image|mimes:jpeg,jpg,png',
            'result_photo.*' => 'image|mimes:jpeg,jpg,png',
        ]);

        $this->order = Order::find($id);
        $this->order->update($request->only(
            'customer_id',
            'price',
            'prepayment',
            'finished_at',
            'delivery_id',
            'delivery_at',
            'info',
            'is_need_cake',
            'subject',
            'result',
            'is_in_catalog',
            'status_id'
        ));

        if ($request->hasFile('subject_photo')) {
            foreach ($request->file('subject_photo') as $file) {
                Subject::storeSubject([
                    'order_id' => $this->order->id,
                    'src' => ImageHandler::saveImage(
                        $file,
                        md5(microtime()),
                        self::SUBJECTS_UPLOAD_DIRECTORY . '/' . $this->order->id,
                        self::IMAGE_WIDTH
                    ),
                ]);
            }
        }

        if ($request->hasFile('result_photo')) {
            foreach ($request->file('result_photo') as $file) {
                Result::storeResult([
                    'order_id' => $this->order->id,
                    'src' => ImageHandler::saveImage(
                        $file,
                        md5(microtime()),
                        self::RESULTS_UPLOAD_DIRECTORY . '/' . $this->order->id,
                        self::IMAGE_WIDTH
                    ),
                ]);
            }
        }

        return redirect()->route('orders.index');
    }

    public function delete($id)
    {
        Order::destroy($id);
        return redirect()->route('orders.index');
    }

    public function dashboard()
    {
        $data = Order::where('status_id', '<>', 3)->orderBy('delivery_at', 'desc')->paginate(self::ORDERS_ON_PAGE);
        return view('orders.index', ['orders' => $data]);
    }

    public function customer($id)
    {
        $data = Order::where('customer_id', '=', $id)->orderBy('delivery_at', 'desc')->paginate(self::ORDERS_ON_PAGE);
        return view('orders.index', ['orders' => $data]);
    }

    public function catalog()
    {
        $data = Order::where('is_in_catalog', '=', '1')->orderBy('price')->get();
        return view('orders.catalog', ['orders' => $data]);
    }
}
