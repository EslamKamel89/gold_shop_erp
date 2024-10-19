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
  var b = {
    "id": 2,
    "category_id": 2,
    "producer_id": 2,
    "name": "product gold 2 updated",
    "price": 200,
    "standard": "24_gold",
    "in_stock": true,
    "quantity": 82,
    "tax": 3.5,
    "created_at": "2024-10-05T20:06:43.000000Z",
    "updated_at": "2024-10-13T14:57:57.000000Z",
    "weight": null,
    "manufacture_cost": null
  };
}
