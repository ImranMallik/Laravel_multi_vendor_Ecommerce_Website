<?php
return [
  'order_status_admin' => [
    'pending' => [
      'status' => 'Pending',
      'details' => 'Your order is currently pending'
    ],
    'processed_and_ready_to_ship' => [
      'status' => 'Processed and ready to ship',
      'details' => 'Your packge has been processed and will be with our delivery parter soon'
    ],

    'dropped_off' => [
      'status' => 'Dropped off',
      'details' => 'Your package has been dropped off by the seller'
    ],
    'shipped' => [
      'status' => 'Shipped',
      'details' => 'Your package has arrived at our logistics facility'
    ],
    'out_of_delivery' => [
      'status' => 'Out For Delivery',
      'details' => 'Our delivery partner will attempt to delivery your package'
    ],
    'delivered' => [
      'status' => 'Delivered',
      'details' => 'Delivered'
    ],
    'canceled' => [
      'status' => 'Canceled',
      'details' => 'Canceled'
    ]

  ],

  'order_status_vendor' => [
    'pending' => [
      'status' => 'Pending',
      'details' => 'Your order is currently pending'
    ],
    'processed_and_ready_to_ship' => [
      'status' => 'Processed and ready to ship',
      'details' => 'Your packge has been processed and will be with our delivery parter soon'
    ]
  ],
];
