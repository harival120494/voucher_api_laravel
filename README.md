INSTALLATION INSTRUCTION
# ==========================

1. Clone the project in to your computer
2. Create database and named it with "aichat"
3. Run command "php artisan migrate" to create the tables needed
4. Run command "php artisan db:seed --class=CustomersTableSeeder" to insert fake data into customers table
5. Run command "php artisan db:seed --class=PurchaseTableSeeder" to insert fake data into purchase_transaction table
6. Run command "php -S localhost:8000 -t public" to run backend service


API Documentation
#===========================
1. Check the customer eligible to get the voucher
    URL : http://localhost:8000/transaction/check_customer/8
    Method : GET
    Params : customer_id
    
    If the customer eligible
    ===========================
    Response : 
    {
        "message": "You get one voucher, Please upload your selfie photo within 10 minutes."
    }

    If the customer not eligible
    ===========================
    Response : 
    {
        "message": "Your transaction not eligible."
    }

    If the customer eligible but the quota is full
    ===========================
    Response : 
    {
        "message": "Oops.. The quota is full"
    }

2. Upload photo and get voucher code
    URL : http://localhost:8000/transaction/upload_photo/8
    Method : POST
    Headers Params : customer_id

    If the customer upload selfie photo within 10 minutes
    ===========================
    Response : 
    {
        "message": "Your voucher is claimed successfully",
        "Voucher Code": "PjkJW1QDHi"
    }

    If the customer upload selfie photo over 10 minutes
    ===========================
    Response : 
    {
        "message": "you have passed the time limit"
    }
