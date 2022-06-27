<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Product;
use App\User;
use App\Models\OrderInvoice;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingAddress;
use App\Traits\CreateSlug;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PavelController extends Controller
{
use CreateSlug;

	public function updateuser(Request $request)
    {
		
		
		for($i=0;$i<150;$i++){
       $operator = array('018', '019', '017', '015', '016');
        $num = str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT);
		
		$method = array('bkash', 'cash-on-deliver', 'shurjopay', 'ssl-commerce', 'cash');
		
		
		$phone = ''.$operator[array_rand($operator, 1)].''.$num.'';
		
		
		$data = User::where('mobile', $phone)->first();
		
		if(!$data){
			$firstname = array('Sanjana', 'Hiya', 'Omi', 'Kalam', 'Humayon', 'Sujan', 'Mahin', 'Rafiq', 'Rafiqul', 'Jeba', 'Asif', 'Aadil', 'Abdullah', 'Abdul', 'Abdus', 'Abrar', 'Abrash', 'Abyad', 'Adam', 'Adeeb', 'Adeel', 'Adib', 'Adnan', 'Adyan', 'Afif', 'Afiq', 'Afraz', 'Aftaab', 'Aftab', 'Afzal', 'Ahad', 'Ahmed', 'Ahnaf', 'Ahsan', 'Ahzab', 'Aiman', 'Ajmal', 'Akbar', 'Akhlaq', 'Akram', 'Al', 'Alaudin', 'Amaan', 'Abdur', 'Amin', 'Amir', 'Amjad', 'Anas', 'Anees', 'Aniq', 'Anis', 'Anjam', 'Ansar', 'Anwaar', 'Anwar', 'Anzar', 'Arbaaz', 'Arif', 'Aryan', 'Asad', 'Ashfaq', 'Ashik', 'Ashmaan', 'Ashraf', 'Aslam', 'Ateeb', 'Atif', 'Atik', 'Atiq', 'Attiq', 'Ayaan', 'Ayaaz', 'Ayaz', 'Aymaan', 'Ayman', 'Ayub', 'Ayyash', 'Ayyub', 'Azad', 'Azam', 'Azhar', 'Azmat', 'Mahad', 'Mahbeer', 'Mahbub', 'Maher', 'Mahfuj', 'Mahfuz', 'Mahmoodullah', 'Mahmud', 'Makhdoom', 'Malik', 'Mamoon', 'Mansoor', 'Mansur', 'Maruf', 'Masood', 'Masrur', 'Masud', 'Masum', 'Matloob');
			
			
$lastname = array('Seikh', 'Zaman', 'Khan', 'Hasan', 'Islam', 'Iqbal', 'Sarker', '', 'Faridi', 'Aalee', 'Adl', 'Ahad', 'Aleem', 'Ali', 'Alim', 'Awwal', 'Azeez', 'Azim', 'Aziz', 'Baari', 'Badee', 'Baith', 'Baqi', 'Bari', 'Baseer', 'Batin', 'Fattah', 'Ghafaar', 'Ghafoor', 'Hafeez', 'Hafiz', 'Hakam', 'Hakeem', 'Haleem', 'Halim', 'Hameed', 'Hamid', 'Hannan', 'Haq', 'Haseeb', 'Hasib', 'Hayy', 'Jabaar', 'Jaleel', 'Jawwad', 'Kabir', 'Kareem', 'Karim', 'Khabir', 'Lateef', 'Maajid', 'Maalik', 'Majeed', 'Mani', 'Mannan', 'Mateen', 'Mubdee', 'Mueed', 'Muhaimin', 'Muhaymin', 'Muhsin', 'Muhyee', 'Muiz', 'Mujeeb', 'Munim', 'Muntaqim', 'Muqeet', 'Muqsit', 'Musawwir', 'Nafi', 'Naseer', 'Noor', 'Qaadir', 'Qadeer', 'Qadir', 'Qayyum', 'Qudoos', 'Rabb', 'Raheem', 'Rahim', 'Rahman', 'Raqib', 'Rauf', 'Tawwab', 'Waali', 'Wahid', 'Wajid', 'Wakil', 'Waliy', 'Rashid', 'Wadood', 'Wahhab', 'Sabur', 'Salaam', 'Samad', 'Sami', 'Sattar', 'Shafi', 'Samad', 'Shaheed', 'Shakur', 'hakeem', 'Kareem');
			
			$address = ShippingAddress::inRandomOrder()->first();
			
			$pricestart = 25000;
			$priceend = 600000;
			$product = Product::whereBetween('selling_price', [$pricestart, $priceend])->where(function ($query) {
    $query->where('category_id', 509)
          ->orWhere('subcategory_id', 215);
})->select('id','selling_price', 'shipping_cost', 'vendor_id')->inRandomOrder()->first();
			
			$name = ''.$firstname[array_rand($firstname, 1)].' '.$lastname[array_rand($lastname, 1)].'';
			$randDate=date('Y-m-d h:i:s', mt_rand(strtotime('2021-08-01'), strtotime('2021-09-01')));
			if(isset($address->get_area->name)){
				$area = $address->get_area->name;
			} else {
				$area = '';
			}
			
			
			if(isset($address->get_city->name)){
				$city = $address->get_city->name;
			} else {
				$city = '';
			}
			if(isset($address->get_state->name)){
				$state = $address->get_state->name;
			} else {
				$state = '';
			}
			
			
		
			
			
			
			 $username = $this->createSlug('users', $name, 'username');
        $username = trim($username, '-');
        $code = rand(1111,9999);
			
			 $user = new User;
        $user->name = $name;
        $user->username = $username;
        $user->mobile = $phone;
        $user->mobile_verification_token = null;
        $user->email_verification_token = Str::random(32);
        $user->password = Hash::make('123456');
        $user->updated_at = $randDate;
        $user->activation = 1;
		$user->country = 18;
		$user->region = $address->region;
		$user->city = $address->city;
		$user->area = $address->area;
		$user->address = $address->address;
		$user->mobile_verified_at = $randDate;
		$user->fake = 1;
		$user->created_at = $randDate;
		$user->updated_at = $randDate;
        if($user->save()){
			
			
			$shipping = new ShippingAddress;
        $shipping->user_id = $user->id;
        $shipping->address = $address->address;
        $shipping->name = $name;
        $shipping->email = null;
        $shipping->phone = $phone;
        $shipping->region = $address->region;
        $shipping->city = $address->city;
        $shipping->area = $address->area;
		$shipping->fake = 1;
		$shipping->country = 18;
		if($shipping->save()){
			
			$qty = 1;
			
			 $prefix = 'WMB';
            $prefix = $prefix.$user->id;
            $order_id = $this->uniqueOrderId('orders', 'order_id', $prefix);
			
			$total_price = ($product->selling_price*$qty);
			$order = new Order();
            $order->order_id = $order_id;
            $order->user_id = $user->id;
            $order->total_qty = $qty;
            $order->total_price = $total_price;
            $order->coupon_code = null;
            $order->coupon_discount = null;
            $order->shipping_method_id = 12;

            $order->billing_name = $name;
            $order->billing_phone = $phone;
            $order->billing_email = null;
            $order->billing_country = 18;
            $order->billing_region = $address->region;
            $order->billing_city = $address->city;
            $order->billing_area = $address->area;
            $order->billing_address = $address->address;
            $order->shipping_cost = $product->shipping_cost;
            $order->shipping_name = $name;
            $order->shipping_phone = $phone;
			$order->fake = 1;
            $order->shipping_email = null;
            $order->shipping_country = 'Bangladesh';
            $order->shipping_region = $state;
            $order->shipping_city = $city;
            $order->shipping_area = $area;
            $order->shipping_address = $address->address;
            $order->order_notes = null;
            $order->currency = Config::get('siteSetting.currency');
            $order->currency_sign = Config::get('siteSetting.currency_symble');
            $order->currency_value = Config::get('siteSetting.currency_symble');
            $order->order_date = $randDate;
			$order->payment_method = $method[array_rand($method, 1)];
            $order->payment_status = 'paid';
            $order->order_status = 'on-delivery';
			$order->created_at = $randDate;
		    $order->updated_at = $randDate;
            if($order->save()){
			
			
			
			 $orderDetails = new OrderDetail();
                    $orderDetails->order_id = $order_id;
                    $orderDetails->offer_id = null;
                    $orderDetails->vendor_id = $product->vendor_id;
                    $orderDetails->user_id = $user->id;
                    $orderDetails->product_id = $product->id;
                    $orderDetails->qty = $qty;
                    $orderDetails->price = $product->selling_price;
                    $orderDetails->shipping_charge = $product->shipping_cost;
					$orderDetails->fake = 1;
                    $orderDetails->coupon_discount = null;
                    $orderDetails->attributes = json_encode(array());
                    $orderDetails->shipping_status = 'on-delivery';
					$orderDetails->created_at = $randDate;
		            $orderDetails->updated_at = $randDate;
                    if($orderDetails->save()){
						 $orderInvoice = new OrderInvoice();
            $orderInvoice->invoice_id = $order_id;
            $orderInvoice->all_orders = $order_id;
            $orderInvoice->notes = 'order: '. $order->order_status.', payment: '.$order->payment_status;
            $orderInvoice->user_id = $user->id;
            $orderInvoice->created_by = 1;
			$orderInvoice->created_at = $randDate;
		    $orderInvoice->updated_at = $randDate;
            if($orderInvoice->save()){
				
				echo 'done '.$i.'<br>';
				
			}
					}
			}
			
		}
		
		
		
		
		
		
		
		}
			
			
			
			
			
			
			
			
			
		} else {
			continue;
		}
		
		}
    }
    
    
   
	
    
   public function removebr(){
		
	
	$min = 26610;
		$max = 29317;
    
   $data = Order::whereBetween('id', [$min, $max])->get();
 foreach($data as $user){
     
     if (strpos($user->billing_phone, '>') !== false) {
    $usr = Order::find($user->id);
    $usr->billing_phone = str_replace(">","",$usr->billing_phone);
    $usr->shipping_phone = str_replace(">","",$usr->shipping_phone);
    $usr->save();
}
    
 }
		
	}
	
	
    
	
	
   
}
