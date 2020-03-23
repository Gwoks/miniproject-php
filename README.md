Recruitment Mini Project
----
**Getting Started**
- run `git clone https://github.com/Gwoks/miniproject-php.git`
- run `cd miniproject-php`
- edit database environment at `config/database.php`
- run `php migrate.php`
- run `php -S localhost:8000`

|Endpoint|Method|Definition|
|:--------|:----------|:------------
`/api/seller.php`|POST|create new user
`/api/disburse.php`|POST| create disbursement
`/api/status.php`|GET| get disbursement status

## Create new user

* URL:

  `/api/seller.php`
  
* Method:

  `POST`
  
* Request Body:
```json
{
  "name": "John Doe",
  "email": "john@doe.com",
  "phone": "02150928829",
  "active_balance": 9000000,
  "bank_code": 123,
  "account_number": 509289
}
```

* Success Response:
```json
{"message":"Berhasil menambah seller"}
```

## Create disbursement

* URL:

  `/api/disburse.php`
  
* Method:

  `POST`
  
* Request Body:
```json
{
  "user_id": 1,
  "amount": 50000
}

```

* Success Response:
```json
{
  "transaction_number":"3329017301",
  "status": "PENDING"
}
```

## Get disbursement status

* URL:

  `/api/status.php`
  
* Method:

  `GET`
  
* Request Body:
```json
{
  "transaction_number": 3329017301
}

```

* Success Response:
```json
{
  "transaction_number":3329017301,
  "status":"PENDING",
  "receipt":"https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg"
}
```
