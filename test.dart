const invoiceRequest = {
  "invoice": {
    "user_id": 1,
    "shop_id": 1,
    "code": "secretCode",
    "total_price": 3000,
    "customer_name": "Eslam Kamel",
    "cutomer_phone": "01024510803",
  },
  "orders": [
    {
      "product_id": 1,
      "quantity": 2,
      "price": 400,
      "description": "some description",
      "codes": ["fdfds", "dfeee"]
    },
    {
      "product_id": 2,
      "quantity": 4,
      "price": 200,
      "description": "some description",
      "codes": ["fdfds", "dfeee", "dfidfi", "fsdfidfj"]
    },
  ],
};
const testOne = {
  "inoviceValidated": [
    {
      "user_id": 1,
      "shop_id": 1,
      "code": "abc",
      "customer_name": "Eslam Ahmed Kamel",
      "customer_phone": "01020504470",
      "total_price": 800.0,
    },
  ]
};

const testTwo = {
  "validatedOrders": [
    [
      {
        "product_id": 1,
        "quantity": 2,
        "codes": ["code 1"],
        "total_price": 200.0,
        "unit_price": 100.0
      },
      {
        "product_id": 2,
        "quantity": 3,
        "codes": ["ABC12345"],
        "total_price": 600.0,
        "unit_price": 200.0
      },
    ],
  ]
};
