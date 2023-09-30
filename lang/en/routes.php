<?php
return [

    // Customer Routes

    'customer-login' => '/en/customer/login',
    'customer-signin' => '/en/customer/customer-login',
    'customer-register' => '/en/customer/registration',
    'customer-registration' => '/en/customer/customer-registration',
    'customerlogout' => '/en/customer/logout',
    'customerchange-password' => '/en/customer/change-password',
    'customerupdate-password' => '/en/customer/update-password',
    'customer-profile' => '/en/customer/profile',
    'customer-profileupdate' => '/en/customer/profile-update',

    'customer-vieworders' => '/en/customer/view-orders',
    'customer-toggle-status' => '/en/customer/toggle-status',
    'customer-order_detail' => '/en/customer/order_detail',
    'customer-order_change' => '/en/customer/order_change',
    'customer-order-file-index-change' => '/en/customer/order-file-index-change',
    'customer-get-order-detail' => '/en/customer/get-order-detail',









    'customer-embroidery-program' => '/en/customer/embroidery-program/',
    'customer-embroidery-program-submit' => '/en/customer/embroidery-order/submit',
    'customer-vector-program' => '/en/customer/vectorization-service/',
    'vector-program' => '/en/customer/vector-order/submit',
    'customer-files' => '/en/customer/files/',
    'customer-orderdetails' => '/en/customer/order-details/',

    'update-embOrder-view' => '/en/customer/embroidery-order/edit/',
    'update-vectorOrder-view' => '/en/customer/vector-order/edit/',
    'delete-embOrder' => 'embroidery-order/delete/',
    'delete-vectorOrder' => 'vector-order/delete/',
    'update-embOrder' => '/en/customer/updated-embroidery-order',
    'update-vectorOrder' => '/en/customer/updated-vector-order/',

    'delete-embFiles' => '/en/customer/emb-delete-file',
    'delete-vectorFiles' => '/en/customer/vec-delete-file/',

    'invite-employee' => '/en/customer/invite-employee/',
    'send-invite' => '/en/customer/send-invite',
    // Employer
    'employer-setPassword' => '/en/customer/setpassword/',
    'employer-Passwordupdate' => '/en/customer/employer-password-update/',
    'employer-listemployees' => '/en/customer/listEmployees/',
    'employer-editemployee' => '/en/customer/edit-employee/',
    'employer-updateemployee' => '/en/customer/update-employee/',
    'employer-deleteemployee' => '/en/customer/deleteemployee/',
    'employer-profile' => '/en/customer/employee-profile/',

    // FreeLancer Routes
    'redirect' => 'freelancer-login',
    'freelancer-login' => 'en/freelancer/login',
    'freelancer-signin' => 'signin',

    'freelancerlogout' => '/en/freelancer/logout/',

    'freelancer-vieworders' => '/en/freelancer/view-orders',
    'freelancer-orderdetails' => '/de/freelancer/order-details/',
    'downloadFile' => '/en/freelancer/download',
    'files' => 'files',
    'delivery-files' => '/en/freelancer/upload-files/',
    'upload-delivery-files' => '/en/freelancer/upload-delivery-files',
    'freelancer-profile' => '/en/freelancer/profile/',
    'freelancer-profile-update' => '/en/freelancer/profile-update/',
    'freelancer-changepassword' => '/en/freelancer/change-password/',
    'freelancer-change-password' => '/en/freelancer/change-password-update',
    'freelancer-delete-files' => '/en/freelancer/deletefiles/',
    'freelancer-filter-data' => '/ene/freelancer/filter-data/',


    // Admin Routes

    'admin-login' => '/en/admin/login/',
    'admin-sign-in' => '/en/admin/signin/',
    // 'admin-vieworders' => '/en/admin/view-orders',
    'admin-logout' => '/en/admin/logout',
    'admin-changepassword' => '/en/admin/change-password',
    'admin-updatepassword' => '/en/admin/update-password',
    'admin-profile' => '/en/admin/profile',
    'admin-updateprofile' => '/en/admin/profile-update',
    'admin-orderdetails' => '/en/admin/order-details/',
    'admin-view-orders' => '/en/admin/admin-view-orders',

    // Employee Routes

];