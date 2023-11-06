<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        "grand_total",
        "email",
        "status",
        "user_id",
        "full_name",
        "tel",
        "address",
        "shipping_method",
        "payment_method",
        "is_paid",
    ];

    const PENDING = 0;
    const CONFIRMED = 1;
    const SHIPPING = 2;
    const SHIPPED = 3;
    const COMPLETE = 4;
    const CANCEL = 5;

    public function Products(){
        return $this->belongsToMany(Product::class,"order_products")->withPivot(["qty","price"]);
    }
    public function getGrandTotal() {
        return "$" .number_format($this->grand_total,2);
    }
    public function getPaid(){
        return $this->is_paid?"Đã thanh toán":"Chưa thanh toán";
    }
    public function getStatus(){
        switch ($this->status){
            case self::PENDING: return"Chờ xác nhận";
            case self::CONFIRMED: return "Dã xác nhận";
            case self::SHIPPING: return "Đang giao hàng";
            case self::SHIPPED: return "Dã giao hàng";
            case self::COMPLETE: return "Hoàn thành ";
            case self::CANCEL: return "Hủy";
        }
    }
    public static function getMonthlyRevenue($year, $month)
    {
        $revenue = self::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('grand_total');

        return $revenue;
    }
}
