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
      "description": "some description",
      "codes": ["fdfds", "dfeee"]
    },
    {
      "product_id": 2,
      "quantity": 4,
      "description": "some description",
      "codes": ["fdfds", "dfeee", "dfidfi", "fsdfidfj"]
    },
  ],
};
const testOne = {
  "product_id": 1,
  "quantity": 2,
  "codes": ["code 1"],
};
const testTwo = [
  {
    "App\\Models\\Item": {
      "id": 10,
      "product_id": 1,
      "code": "code 1",
      "created_at": "2024-10-14T06:32:46.000000Z",
      "updated_at": "2024-10-14T06:32:46.000000Z",
      "shop_id": 1,
      "sold": false,
      "creditor_id": 1
    }
  }
];
