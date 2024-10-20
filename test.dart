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

test() {
  var a = {
    "id": 2,
    "product_id": 2,
    "code": "code 2",
    "created_at": "2024-10-13T16:05:11.000000Z",
    "updated_at": "2024-10-13T16:05:11.000000Z",
    "shop_id": 2,
    "sold": false,
    "creditor_id": 2
  };
  var b = [
    {
      "product_id": 1,
      "unit_price": 2000,
      "codes": ["code-product-1-item-2", "code-product-1-item-3", "code-product-1-item-4"],
      "quantity": 3,
      "total_price": 6000
    },
    {
      "product_id": 2,
      "unit_price": 100000,
      "codes": ["code-product-2-item-2"],
      "quantity": 1,
      "total_price": 100000
    }
  ];
}
