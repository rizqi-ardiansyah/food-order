# An-Dox (Food Ordering System in Restaurants Equipped with Human Detection Sensors)

An-dox is a food ordering system that is equipped with a customer detection sensor is an innovation that aims to improve customer experience in the food service industry. The main function of this system is to optimize the ordering process, reduce waiting times, and increase efficiency in service.

 ![image](https://github.com/rizqi-ardiansyah/food-order/assets/86498942/86c90efe-b1cd-4d2b-8835-732a8e8f290d)

# Feature - User Section

### 1. Choose food

- In choosing food, customers can choose food from a menu list or easily by searching in the search field
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/41f85850-48ae-4d66-b641-820540a3dd2b" width="800" />

### 2. Customer login

- The customer login feature is used so that customers can place food orders. In the ID table column, you must fill in the table id sent by the sensor on the table

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/8c329fe3-3738-40c0-a46a-b87de33324ff" width="800" />

### 3. Add to cart

- This feature is used so customers can choose more than one menu

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/738f8376-f6d2-45ad-b4d2-e3cbfb91fbc5" width="800" />

### 4. Order confirmation

- Order confirmation is used by customers to confirm orders that will be ordered at restaurants

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/e2bc0ab9-5f12-40fb-84c0-f778bbfdcc11" width="800" />
  
### 4. Order status

- The order status will function as a realtime status related to the restaurant service process. There are 4 statuses, namely ordered, on-delivery, delivered and canceled

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/2d0d4b71-487d-455e-874d-6046c3ebeddc" width="800" />

# Feature - Admin Section

### 1. Login

- The admin feature is used by the admin in managing orders made by customers
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/8a83e15d-e898-4c66-acc6-2fdcb2e7a8d4" width="800" />

  *Default admin account*
  ```sh
    Email: admin
    Password: admin
    ```
  
### 2. Dashboard

- In the dashboard display, a summary will be displayed of sharing ordering information such as the number of categories, number of food menus, total orders, to profits

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/7f161b5d-6e3c-4d75-8129-41eb8259df79" width="800" />

### 3. Manage admin

- This feature is used to manage admin data that can login to the admin page

  *Admin data display*

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/8d7898f7-d386-4761-8a92-b537c5ac7c1f" width="800" />

  *Display adds admin data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/eb412aab-0da2-4fb7-aafb-c4104ff99b68" width="800" />

  *Display updates admin data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/1eaa2a56-ae07-49bb-a5d7-0dfd14d902c9" width="800" />

### 4. Manage category

- Manage category is used to manage food menu categories in restaurants such as food, drink, and snack categories

  *Category data display*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/363357fd-bab0-4a71-80a2-e6e2598ce1da" width="800" />
  
  *Display adds category data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/e1715268-c36b-46bb-a820-aa7d46b6e8f8" width="800" />
  
  *Display updates category data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/ecd5f583-4c5d-427e-beab-cbe47f3d4428" width="800" />
  
### 5. Manage food

- Manage food is done to manage food that will be sold in restaurants. Therefore the admin must fill in the name of the food, stock, and selling costs

  *Food data display*

  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/989bccf1-c434-41e0-b7eb-d7d90f2f934d" width="800" />
  
  *Display adds food data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/4126b86c-7895-4df4-aacd-bce9d29766c0" width="800" />

  *Display updates food data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/6aba7f49-8776-4db8-af9e-f102582ff588" width="800" />

### 6. Manage order

- The order management feature is used to manage orders made by customers. In this feature, the admin can only make updates regarding customer order data

  *Display updates order data*
  
  <img src="https://github.com/rizqi-ardiansyah/simoyam/assets/86498942/9f67598d-2bd5-4f36-bf99-e0daa600a05b" width="800" />

# Installation

1. Clone the repository
   
2. Install composer
    ```bash
    composer install
    ```
    
3. Copy file .env.example
     ```bash
    cp .env.example .env
    ```
     
5. Generate the key
    ```bash
    php artisan key:generate
    ```

8. Do the migrations first
    ```sh
    php artisan:migrate
    ```

9. Do the seeder first
    ```sh
    php artisan db:seed
    ```
    
10. Run projects
    ```sh
    php artisan serve
    ```
    
# License

The MIT License (MIT) 2023 - [Rizqi Ardiansyah](https://github.com/rizqi-ardian/). Please have a look at the [LICENSE.md](LICENSE.md) for more details.
