<?php
$title = 'Create User';
require APPROOT . '/views/inc/header.php';
?>
<?php require APPROOT . '/views/inc/sidebar.php'; ?>

<h1 class="text-3xl text-black pb-6 text-white"><b>Create User</b></h1>
<!-- <label for="database" class="absolute right-0 text-sm font-medium text-gray-700">Database</label>
      <select id="database" name="database" autocomplete="database" class="mr-6 absolute right-0 block w-64 rounded-md border border-gray-300 bg-white py-2 px-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
        <option>RMSPRD</option>
        <option>RDWPRD</option>
        <option>BSPIKCONCORD</option>
        <option>OBIEE</option>
      </select> -->
<div class="hidden sm:block" aria-hidden="true">
  <div class="py-6">
    <div class="border-t border-gray-200"></div>
  </div>
</div>
<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-300">Employee Information</h3>
        <p class="mt-1 text-sm text-gray-500"><em>Include remarks to notice user access.</em></p>
      </div>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <div class="bg-white overflow-hidden shadow sm:rounded-md pb-44 relative">
        <form action="<?php echo URLROOT; ?>/users/create" method="POST">
          <div class="bg-white px-4 py-5 sm:p-6">
            <div class="grid mt-10 grid-cols-6 gap-16">
              <div class="col-span-6 sm:col-span-2">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Firstname</label>
                <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm " placeholder="John">
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label for="middle-name" class="block text-sm font-medium text-gray-700">Middlename (Optional)</label>
                <input type="text" name="middle-name" id="middle-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Lastname</label>
                <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm " placeholder="Doe">
              </div>

              <div class="col-span-6 sm:col-span-2">
                <label for="Id" class="block text-sm font-medium text-gray-700">Employee ID</label>
                <input type="number" name="Id" id="Id" autocomplete="Id" class="mt-1 block w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm " placeholder="1234567890">
              </div>

              <div class="col-span-6 sm:col-span-4">
                <label for="requestor" class="block text-sm font-medium text-gray-700">Requested By</label>
                <input type="text" name="requestor" id="requestor" autocomplete="requestor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm " placeholder="John Doe">
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="application" class="block text-sm font-medium text-gray-700">Application</label>
                <select id="application" name="application" autocomplete="application" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                  <option>ORMS</option>
                  <option>OREIM</option>
                  <option>ORPM</option>
                  <option>KCS RETAIL</option>
                  <option>CUSTOM APP (OTHERS)</option>
                </select>
              </div>
            </div>
            <br>
            <div>
              <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
              <div class="mt-1">
                <textarea id="remarks" name="remarks" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm " placeholder="Enter Remarks"></textarea>
              </div>
              <p class="mt-2 text-sm text-gray-500"><em>User account remarks (ie: Access).</em></p>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 absolute inset-x-0 bottom-0">
            <button type="submit" name="CreateUser" value="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              Create
              <i class="fas mt-1 fa-user-plus ml-2"></i>
            </button>
          </div>
        </form>
        <div class="mr-32 px-4 py-3 text-right sm:px-6 absolute inset-x-0 bottom-0">
          <a href="<?php echo URLROOT; ?>/users/show">
            <button type="submit" name="CreateUser" value="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              Cancel
              <i class="fas mt-1 fa-times ml-2"></i>
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>