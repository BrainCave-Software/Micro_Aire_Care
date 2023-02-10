<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="tags" content="Developed by BrainCave Software Pvt. Ltd" href="https://braincavesoft.com/">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('backend/vendors/mdi/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/flag-icon-css/css/flag-icon.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}" />
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png')}}" />

    <link
      rel="stylesheet"
      href="{{ asset('backend/vendors/css/vendor.bundle.base.css')}}"
    />
    <style>

      input[type=search],
      #selectCategory,
      #selectVarient,
      #stockAgingFilter,
      #selectInvoiceStatus,
      #selectSalesPaymentStatus{
        height: 38px !important;
        display: inline-block;
        border: 2px solid #ccc;
        padding: 5px 2px !important;
        box-sizing: border-box;
        margin: auto !important;
      }

      #resetVendorFilterSection,
      #resetPurchaseReqFilter,
      #resetPurchaseOrderFilter,
      #resetsalesQuotationBtn,
      #resetcustomerManagementBtn,
      #resetWarehouseFilterBtn,
      #stockTrackingModalPopBtn,
      #searchLabel,
      #resetREFilterCategory,
      #resetREFilter,
      #resetProductFilter,
      #resetProductFilterStockAgaing,
      #resetSalesInvoiceFilter,
      #resetSalesPaymentFilter{
        /* margin: auto ;
        font-size: small !important;
        border: 2px solid !important;
        border-left-color: #ccc !important;
        border-top-color: #ccc !important;
        border-bottom-color: #ccc !important;
        border-right-color: #3F50F6 !important;
        padding: 10.8px 8px !important; */
        background-color: #52cd53;
        color: #fff;
        border-radius: 4px;
        border: 1px solid transparent;
         border-color: #28a745;
      }

      input, select{
        color: black !important;
      }
      #resetVendorFilterSection:hover,
      #resetPurchaseReqFilter:hover,
      #resetPurchaseOrderFilter:hover,
      #resetsalesQuotationBtn:hover,
      #resetcustomerManagementBtn:hover,
      #resetWarehouseFilterBtn:hover,
      #stockTrackingModalPopBtn:hover,
      #searchLabel:hover,
      #resetREFilterCategory:hover,
      #resetREFilter:hover,
      #resetProductFilter:hover,
      #resetProductFilterStockAgaing:hover,
      #resetSalesInvoiceFilter:hover,
      #resetSalesPaymentFilter:hover{
        text-decoration: none;
    background-color: #28a745;
    border-color: #28a745;
      }
    </style>
    
  </head>
  <body onload="init()">
    <div class="container-scroller">
