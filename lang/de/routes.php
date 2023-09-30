<?php
return [
    // Customer Routes
    // 'redirect' => 'customer-login',
    'customer-login' => '/de/customer/login',
    'customer-signin' => '/de/customer/customer-login',
    'customer-register' => '/de/customer/registration',
    'customer-registration' => '/de/customer/customer-registration',
    'customerlogout' => '/de/customer/logout',

    'customerchange-password' => '/de/customer/change-password',
    'customerupdate-password' => '/de/customer/update-password',
    'customer-profile' => '/de/customer/profile',
    'customer-profileupdate' => '/de/customer/profile-update',

    'customer-vieworders' => '/de/customer/view-orders',
    'customer-toggle-status' => '/de/customer/toggle-status',
    'customer-order_detail' => '/de/customer/order_detail',
    'customer-order_change' => '/de/customer/order_change',
    'customer-order-file-index-change' => '/de/customer/order-file-index-change',
    'customer-get-order-detail' => '/de/customer/get-order-detail',







    'customer-embroidery-program' => '/de/customer/embroidery-program/',
    'customer-embroidery-program-submit' => '/de/customer/embroidery-order/submit',
    'customer-vector-program' => '/de/customer/vectorization-service/',
    'vector-program' => '/de/customer/vector-order/submit',
    'customer-files' => '/de/customer/files/',
    'customer-orderdetails' => '/de/customer/order-details/',

    'update-embOrder-view' => '/de/customer/embroidery-order/edit/',
    'update-vectorOrder-view' => '/de/customer/vector-order/edit/',
    'delete-embOrder' => 'embroidery-order/delete/',
    'delete-vectorOrder' => 'vector-order/delete/',
    'update-embOrder' => '/de/customer/updated-embroidery-order',
    'update-vectorOrder' => '/de/customer/updated-vector-order/',

    'delete-embFiles' => '/de/customer/emb-delete-file',
    'delete-vectorFiles' => '/de/customer/vec-delete-file/',

    'invite-employee' => '/de/customer/invite-employee/',
    'send-invite' => '/de/customer/send-invite',
    // Employer
    'employer-setPassword' => '/de/customer/setpassword/',
    'employer-Passwordupdate' => '/de/customer/employer-password-update/',
    'employer-listemployees' => '/de/customer/listEmployees/',
    'employer-editemployee' => '/de/customer/edit-employee/',
    'employer-updateemployee' => '/de/customer/update-employee/',
    'employer-deleteemployee' => '/de/customer/deleteemployee/',
    'employer-profile' => '/de/customer/employee-profile/',




    // FreeLancer Routes
    'redirect' => 'freelancer-login',
    'freelancer-login' => '/de/freelancer/login',
    'freelancer-signin' => 'signin',

    'freelancerlogout' => '/de/freelancer/logout/',

    'freelancer-vieworders' => '/de/freelancer/view-orders',
    'freelancer-orderdetails' => '/de/freelancer/order-details/',
    'downloadFile' => '/de/freelancer/download',
    'files' => 'files',
    'delivery-files' => '/de/freelancer/upload-files/',
    'upload-delivery-files' => '/de/freelancer/upload-delivery-files',

    'freelancer-profile' => '/de/freelancer/profile/',
    'freelancer-profile-update' => '/de/freelancer/profile-update/',
    'freelancer-changepassword' => '/de/freelancer/change-password/',
    'freelancer-change-password' => '/de/freelancer/change-password-update',
    'freelancer-delete-files' => '/de/freelancer/deletefiles/',
    'freelancer-filter-data' => '/de/freelancer/filter-data/',








    // Admin Routes
    'admin-login' => '/de/admin/login/',
    'admin-sign-in' => '/de/admin/signin/',
    // 'admin-vieworders' => '/de/admin/view-orders',
    'admin-orderdetails' => '/de/admin/order-details/',
    'admin-logout' => '/de/admin/logout',
    'admin-changepassword' => '/de/admin/change-password',
    'admin-updatepassword' => '/de/admin/update-password',
    'admin-profile' => '/de/admin/profile',
    'admin-updateprofile' => '/de/admin/profile-update',
    'admin-view-orders' => '/de/admin/admin-view-orders',


];