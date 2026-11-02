<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getOrderStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return 'در انتظار پرداخت';
            case 1:
                return 'در حال پردازش';
            case 2:
                return 'تحویل شده';
            case 3:
                return 'لغو شده';
            case 4:
                return 'مرجوعی';
            default:
                return 'وضعیت نامشخص';
        }
    }

    public function setOrderStatusAttribute($value)
    {
        if (in_array($value, [0, 1, 2, 3, 4])) {
            $this->attributes['order_status'] = $value;
        } else {
            throw new \InvalidArgumentException('مقدار وضعیت سفارش نامعتبر است.');
        }
    }
}
