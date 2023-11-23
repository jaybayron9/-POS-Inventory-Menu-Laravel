<x-layout.app>
    <x-layout.navbar />
    <section class="h-screen bg-gray-200">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6">
            <div class="sm:flex">
                <a href="./" class="max-w-screen-md mb-8">
                    <h2 class="text-4xl tracking-tight font-extrabold text-gray-900"> <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-gray-900">
                        HOTPLATE</span> SIZZLING HOUSE</h2>
                </a>
                <div class="ml-auto mb-4 text-right">
                    <button type="button" id="daily-report-btn" class="whitespace-nowrap bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100">Daily Report</button>
                </div>
            </div>
            <div id="show-daily-report" class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
                <div class="p-2 rounded shadow-md bg-white mt-auto">
                    <div id="sale" class="text-2xl font-bold"></div>
                    <div class="lg:flex gap-x-3">
                        <label class="mb-2 text-xl font-semibold whitespace-nowrap"">Total Sale</label>
                        <select name="" id="day-sale" class="h-8 p-1 rounded ml-auto">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last-7-days">7 Days</option>
                            <option value="last-30-days">30 Days</option>
                        </select>
                    </div>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="customer" class="text-2xl font-bold"></div>
                    <div class="lg:flex gap-x-3">
                        <label class="mb-2 text-xl font-semibold whitespace-nowrap">Total Customers</label>
                        <select name="" id="day-customer" class="h-8 p-1 rounded ml-auto">
                            <option value="today">Today</option>
                            <option value="yesterday">Yesterday</option>
                            <option value="last-7-days">7 Days</option>
                            <option value="last-30-days">30 Days</option>
                        </select>
                    </div>
                </div>

                <div class="p-2 rounded shadow-md bg-white">
                    <div id="product-sale" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold ">Total Product Sale</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="aov" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Average Order Value</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="thebest" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Best Seller</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="pending" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Pending Orders</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="unpaid" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Unpaid Orders</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="total-product" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Total Products</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="available" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Available Products</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="unvailable" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Unavailable Products</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="reorder" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Reorder Alert</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="low" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Low Stock</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="out-stock" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Out Of Stock</label>
                </div>
                <div class="p-2 rounded shadow-md bg-white">
                    <div id="total-staffs" class="text-2xl font-bold"></div>
                    <label class="mb-2 text-xl font-semibold">Total Staffs</label>
                </div>
            </div>
        </div>
    </section>

    <x-slot:scripts>
        <script type="text/javascript"> 
            function showTotalSale(day) {
                $.ajax({
                    url: `/date/total_sale/${day}`,
                    method: 'GET',
                    success: function(data) {
                        $('#sale').html(data);
                        $('#day-sale').val(day);
                    }
                });
            }

            showTotalSale('yesterday');

            $('#day-sale').change(function() {
                var day = $(this).val();
                showTotalSale(day);
            });

            function showTotalCustomer(day) {
                $.get(`/date/total_customer/${day}`, (res) => { 
                    $('#customer').html(res);
                    $('#day-customer').val(day);
                }); 
            }

            showTotalCustomer('yesterday');

            $('#day-customer').change(function() {
                var day = $(this).val();
                showTotalCustomer(day); 
            });

            $('#product-sale').load('/dashbaord/product_sale');
            $('#total-product').load('/dashboard/total_product');
            $('#aov').load('/dashbaord/average_order');
            $('#pending').load('/dashboard/pending_order');
            $('#unpaid').load('/dashboard/unpaid_order');
            $('#reorder').load('/dashboard/product_reorder');
            $('#low').load('/dashboard/product_low');
            $('#out-stock').load('/dashboard/out_stock');
            $('#total-staffs').load('/dashboard/total_staffs');
            $('#thebest').load('/dashboard/product_best');
            $('#unvailable').load('/dashboard/unavailable_product');
            $('#available').load('/dashboard/available_product');

            $('#daily-report-btn').click(function() {
                $('#show-daily-report').html('<object data="/dashboard/daily_report" type="application/pdf" class="w-full h-screen">').removeClass("space-y-8 grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-6 space-y-0");
            });
        </script>
    </x-slot:scripts>
</x-layout.app>