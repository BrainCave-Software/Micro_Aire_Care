<div class="modal fade viewShipping" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lgs" role="document">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shipping Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">

        <!-- Choose Customer  -->
        <div class="form-group row">
          <label for="viewcustomerNameShip" class="col-sm-3 col-form-label">Customer</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="ViewDropshipping" readonly />
          </div>
        </div>


        <!-- Product Varient -->
        <div class="form-group row">
          <label for="order_no" class="col-sm-3 col-form-label">Order No.</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewShippingOrder_no" readonly />
          </div>
        </div>

        <!-- Product Category -->
        <div class="form-group row">
          <label for="viewMobile" class="col-sm-3 col-form-label">Mobile No.</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewMobile" readonly />
          </div>
        </div>

        <!-- SKU Code -->
        <div class="form-group row">
          <label for="viewgetmerchantShip" class="col-sm-3 col-form-label">Merchant</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewgetmerchantShip" readonly />
          </div>
        </div>

        <!-- Minimum Scale Price -->
        <div class="form-group row">
          <label for="viewinitial_addressShip" class="col-sm-3 col-form-label">Initial Address</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewinitial_addressShip" readonly />
          </div>
        </div>

        <!-- Tax -->
        <div class="form-group row">
          <label for="viewfinal_addressShip" class="col-sm-3 col-form-label">Final Address</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewfinal_addressShip" readonly />
          </div>
        </div>

        <!-- Quantity -->


        <!-- Supplier Code -->
        <div class="form-group row">
          <label for="viewdateShip" class="col-sm-3 col-form-label">date</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewdateShip" name="date" />
          </div>
        </div>
        <!-- Status -->
        <div class="form-group row">
          <label for="viewstatusShip" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewstatusShip" readonly />
          </div>
        </div>
        <!-- Payment Status -->
        <div class="form-group row">
          <label for="viewpayment_statusShip" class="col-sm-3 col-form-label">Payment Status</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="viewpayment_statusShip" readonly />
          </div>
        </div>
        <div class="form-group row">
          <div class="col">
            <fieldset class="border border-secondary p-2">
              <legend class="float-none w-auto p-2">Product Details</legend>
              <span style="color:red; font-size:small;" id="createdeliverytableEmptyError"></span>

              <div class="table-responsive-sm border border-secondary" style="overflow-x:scroll;">
                <table class="table text-center border" id="viewproductTableShipping">
                  <thead>
                    <tr>
                      <th>Sl.No</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Varient</th>
                      <th>Description</th>
                      <th>Quantity</th>
                      <th>Unit Price</th>
                      <th>Gross Amount</th>
                      <th>Net Amount</th>
                    </tr>
                  </thead>
                  <tbody id="viewproductTableBodyShipping"></tbody>
                </table>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>