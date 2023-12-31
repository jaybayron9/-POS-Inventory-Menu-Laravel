<x-layout.app>
    <x-layout.navbar />
    <section class="pt-5 pb-8 mx-4 grid grid-cols-7 gap-4"> 
        <div id="menu-list" class="col-span-5 mb-6 border border-gray-200 shadow-lg bg-gray-50 h-full">
            <div class="flex items-center py-2 px-4 border-b border-gray-300 shadow bg-white"> 
                <div class="inline-flex" role="group">
                    <button id="nav-meals" type="button" class="inline-flex items-center px-4 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                        🥘
                        Meals
                    </button>
                    <button id="nav-drinks" type="button" class="inline-flex items-center px-4 py-1 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-900 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                        🍹
                        Drinks
                    </button>
                    <button id="nav-add-ons" type="button" class="inline-flex items-center px-4 py-1 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white">
                        🍚
                        Add-ons
                    </button>
                </div> 
                <div class="md:text-right ml-auto w-2/5">
                    <input type="search" name="" maxlength="35" placeholder="Search Product" class="search text-center h-7 rounded-md bg-gray-50  border-gray-800 placeholder:font-light placeholder:text-gray-400">
                </div> 
            </div>
            <ul id="meals-menu" class="meal-list pr-3 mt-4">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-4 grid-cols-2 gap-3 ml-3 mb-4"> 
                    @foreach ($products('meals') as $product) 
                        <li class="meal sm:mb-0 mb-10">
                            <div class="bg-cover bg-center bg-no-repeat rounded-md shadow-xl" style="background-image: url('{{ asset("storage/uploads/" . ($product->picture ?? 'default.jpg')) }}'); height: 130px; width: 130px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-10 h-9 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                                </svg>
                                <div class="absolute font-medium ml-2 mt-2 z-50 text-white">
                                    <a data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" class="sub-button hover:cursor-pointer">
                                        <?= $product->price ?>
                                    </a>
                                </div>
                                <div class="{{ $product->status === 'available' ? 'hidden' : '' }} absolute ml-8 font-bold" style="font-size:18px">
                                    <p class="text-rose-500 bg-gray-200 rotate-45 mt-7 px-1"><?= $product->status ?></p>
                                </div>
                                <div class="flex">
                                    <span class="inline-flex justify-center items-center font-bold text-red-500"></span>
                                    <a data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" style="height: 130px; width: 130px;" class="<?= $product->status !== 'Out of Stock' ? 'add-button' : '' ?> hover:cursor-pointer rounded-lg ml-auto inline-flex justify-center items-center p-1 text-sm font-medium bg-transparent border hover:bg-gray-100 hover:opacity-50 dark:text-gray-800 dark:focus:ring-gray-700 z-100 pb-6" type="button">
                                    </a>
                                </div>
                            </div>
                            <div class="text-center -mt-20 mb-3 text-shadow-lg" style="font-size: 23px; text-shadow: 5px 5px 10px rgba(0, 0, 0, 1);">
                                <p data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" class="{{ $product['status'] !== 'Out of Stock' ? 'add-button' : '' }} font-bold text-white capitalize"><?= $product->product_name ?></p>
                            </div>
                        </li>
                    @endforeach
                </div>
            </ul>
            <ul id="drinks-menu" class="meal-list hidden mt-4 pr-3">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-4 grid-cols-2 gap-3 ml-3 mb-4">
                    @foreach ($products('drinks') as $product) 
                        <li class="meal sm:mb-0 mb-10">
                            <div class="bg-cover bg-center bg-no-repeat rounded-md shadow-xl" style="background-image: url('{{ asset("storage/uploads/" . ($product->picture ?? 'default.jpg')) }}'); height: 130px; width: 130px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-10 h-9 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                                </svg>
                                <div class="absolute font-medium ml-2 mt-2 z-50 text-white">
                                    <a data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" class="sub-button hover:cursor-pointer">
                                        <?= $product->price ?>
                                    </a>
                                </div>
                                <div class="{{ $product->status === 'available' ? 'hidden' : '' }} absolute ml-8 font-bold" style="font-size:18px">
                                    <p class="text-rose-500 bg-gray-200 rotate-45 mt-7 px-1"><?= $product->status ?></p>
                                </div>
                                <div class="flex">
                                    <span class="inline-flex justify-center items-center font-bold text-red-500"></span>
                                    <a data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" style="height: 130px; width: 130px;" class="<?= $product->status !== 'Out of Stock' ? 'add-button' : '' ?> hover:cursor-pointer rounded-lg ml-auto inline-flex justify-center items-center p-1 text-sm font-medium bg-transparent border hover:bg-gray-100 hover:opacity-50 dark:text-gray-800 dark:focus:ring-gray-700 z-100 pb-6" type="button">
                                    </a>
                                </div>
                            </div>
                            <div class="text-center -mt-20 mb-3 text-shadow-lg" style="font-size: 23px; text-shadow: 5px 5px 10px rgba(0, 0, 0, 1);">
                                <p data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" class="{{ $product['status'] !== 'Out of Stock' ? 'add-button' : '' }} font-bold text-white capitalize"><?= $product->product_name ?></p>
                            </div>
                        </li>
                    @endforeach
                </div>
            </ul>
            <ul id="add-ons-menu" class="meal-list hidden mt-4 pr-3">
                <div class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-4 grid-cols-2 gap-3 ml-3 mb-4">
                    @foreach ($products('add-ons') as $product) 
                        <li class="meal sm:mb-0 mb-10">
                            <div class="bg-cover bg-center bg-no-repeat rounded-md shadow-xl" style="background-image: url('{{ asset("storage/uploads/" . ($product->picture ?? 'default.jpg')) }}'); height: 130px; width: 130px;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-10 h-9 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" />
                                </svg>
                                <div class="absolute font-medium ml-2 mt-2 z-50 text-white">
                                    <a data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" class="sub-button hover:cursor-pointer">
                                        <?= $product->price ?>
                                    </a>
                                </div>
                                <div class="{{ $product->status === 'available' ? 'hidden' : '' }} absolute ml-8 font-bold" style="font-size:18px">
                                    <p class="text-rose-500 bg-gray-200 rotate-45 mt-7 px-1"><?= $product->status ?></p>
                                </div>
                                <div class="flex">
                                    <span class="inline-flex justify-center items-center font-bold text-red-500"></span>
                                    <a data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" style="height: 130px; width: 130px;" class="<?= $product->status !== 'Out of Stock' ? 'add-button' : '' ?> hover:cursor-pointer rounded-lg ml-auto inline-flex justify-center items-center p-1 text-sm font-medium bg-transparent border hover:bg-gray-100 hover:opacity-50 dark:text-gray-800 dark:focus:ring-gray-700 z-100 pb-6" type="button">
                                    </a>
                                </div>
                            </div>
                            <div class="text-center -mt-20 mb-3 text-shadow-lg" style="font-size: 23px; text-shadow: 5px 5px 10px rgba(0, 0, 0, 1);">
                                <p data-row-data="{{ $product->product_id . ',' . $product->product_name . ',' . $product->price }}" class="{{ $product['status'] !== 'Out of Stock' ? 'add-button' : '' }} font-bold text-white capitalize"><?= $product->product_name ?></p>
                            </div>
                        </li>
                    @endforeach
                </div>
            </ul>
        </div>  

        <div class="col-span-2 shadow-lg bg-gray-50 border border-gray-200">
            <div class="mb-3">
                <div style="height: 410px">
                    <div id="table-scrollbar" class="d-table overflow-x-auto overflow-y-auto" style="max-height: 400px;">
                        <table id="menu-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase sticky top-0 z-50">
                                <tr class="border-b border-gray-100 shadow bg-white">
                                    <th scope="col" class="px-4 py-1">
                                        Product
                                    </th>
                                    <th scope="col" class="px-4 py-1">
                                        Price
                                    </th>
                                    <th scope="col" class="px-4 py-1">
                                        QTY
                                    </th>
                                    <th scope="col" id="acthd" class="py-1">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="order-list" class="">
                                <!-- Orders Goes Here -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div>
                    <div class="flex w-full border-t border-gray-200">
                        <p class="p-3 ml-3 font-semibold text-xs">SUBTOTAL</p>
                        <p class="p-3 mx-16 font-semibold text-lg text-green-700">₱ <span id="total" class="text-gray-900"></span></p>
                    </div>
                    <div class="discounttotal hidden flex w-full bg-gray-50 border-t border-gray-200">
                        <p class="p-3 ml-3 font-semibold text-xs">TOTAL DUE</p>
                        <p class="p-3 mx-6 font-semibold text-xl text-green-700">₱ <span id="finaltotal" class="text-gray-900"></span></p>
                    </div>
                </div>

                <!-- Alert -->
                {{-- <div id="success-alert" class="<?= !isset($_SESSION['success']) ? 'hidden' : '' ?> flex px-4">
                    <div class="flex px-4 py-2 mb-4 text-sm text-green-800 rounded-lg bg-green-100 text-green-700 w-full" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium"><?= $_SESSION['success'] ?></span>
                        </div>
                    </div>
                </div> --}}

                <div id="error-alert-div" class="flex hidden px-4">
                    <div class="flex px-4 py-2 w-full mb-4 text-sm text-red-800 rounded-lg bg-red-100 text-red-700" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span id="error-alert-msg" class="font-medium"></span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 mb-1 px-2">
                    <div>
                        <label for="Payment amount" class="font-semibold text-xs">PAYMENT</label>
                        <input type="text" id="payment-amount" name="payment_amount" title="Payment amount" data-row-data="1" placeholder="0" maxlength="11" class="payment w-full rounded-l-md border-gray-400 shadow-md text-green-700 myInput placeholder:text-green-500 py-1" list="paymenttList">
                        <datalist id="paymenttList">
                            <option id="op-totaldue" value="">
                                <option id="op-subtotal" value="">
                        </datalist>
                    </div>

                    <div>
                        <label for="Change" class="font-semibold text-xs">CHANGE</label>
                        <input type="number" id="change" name="change" disabled title="Change" placeholder="0" class="w-full px-2 rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500 py-1">
                    </div>

                    <div>
                        <label for="Discount" class="font-semibold text-xs">%&nbsp;DISCOUNT</label>
                        <input type="text" id="discount" name="discount" title="Discount" data-row-data="2" placeholder="0" maxlength="5" class="discount w-full rounded-l-md border-gray-400 shadow-md text-green-700 myInput placeholder:text-green-500 py-1" list="discountList">
                        <datalist id="discountList">
                            <?php for ($i=1; $i <= 99; $i++) { ?>
                            <option value="<?= $i ?>">
                            <?php } ?>
                        </datalist>
                    </div>

                    <div>
                        <label for="Discounted amount" class="font-semibold text-xs">DISCOUNTED</label>
                        <input type="number" id="discountamount" name="discountamount" disabled title="Discount amount" placeholder="0" class="w-full rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500 py-1">
                    </div>
                </div>

                <div class="flex items-center justify-center gap-3 px-2">
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <div id="customer-label">
                                <label class="font-semibold text-xs">CUSTOMER <span class="text-red-500">*</span></label>
                                <div id="cust-profile" class="w-9 h-5 ml-auto text-sky-700 hidden" data-popover-target="customer-profile" data-popover-placement="top">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                    </svg>
                                </div>
                                <div data-popover id="customer-profile" role="tooltip" class="absolute inline-block text-sm transition-opacity duration-300 border rounded shadow-xl opacity-0 w-72 bg-white border-gray-600 text-gray-700">
                                    <div class="p-2 space-y-1">
                                        <p id="info-customer" class="font-semibold text-medium text-dark text-lg uppercase text-center rounded shadow shadow-gray-400">
                                        </p>
                                        <p class="font-light text-sm text-dark capitalize">Invoice # :
                                            <span id="info-voice-no" class="font-normal"></span>
                                        </p>
                                        <p class="font-light text-sm text-dark capitalize">Created :
                                            <span id="info-created-at" class="font-normal"></span>
                                        </p>
                                        <p class="font-light text-sm text-dark capitalize">Status :
                                            <span id="info-status" class="font-normal"></span>
                                        </p>
                                        <div id="info-odered-list" class="grid grid-cols-4 overflow-y-auto border border-gray-700 shadow-xl rounded" style="max-height: 200px;">
                                            <!-- Info Ordered Goes Here -->
                                        </div>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </div>
                            <input type="text" id="customer" name="customer" title="Customer name" placeholder="Table #" maxlength="20" data-row-data="3" class="customer w-full rounded-md border-gray-400 shadow-md py-1" list="tableList">
                            <datalist id="tableList" class="w-10">
                                <?php for ($i = 1; $i <= 20; $i++) { ?>
                                <option value="Table <?= $i ?>">
                                <?php } ?>
                            </datalist>
                        </div>
                        <div>
                            <label for="Note" class="font-semibold text-xs">NOTE</label>
                            <textarea type="text" name="" id="note" cols="30" title="Special Request" rows="1" maxlength="75" placeholder="Any..." style="height: 34px;" class="w-full rounded-md overflow-y-hidden w-full border-gray-400 shadow-md py-1"></textarea>
                        </div>

                        <div>
                            <label for="Note" id="addons-label" class="font-semibold text-xs">ADD-ONS</label>
                            <input type="hidden" id="order_id">
                            <div class="flex">
                                <input type="text" id="add-ons-to" placeholder="Table" title="Table no. | Invoice no. | Order Id | Time" maxlength="50" data-row-data="4" class="addons w-full rounded-l-full border-gray-400 shadow-md px-1 text-center mr-1 py-1" list="addonsTableList">
                                {{-- <datalist id="addonsTableList" class="w-10">
                                    <?php foreach($menu->tableAddons() as $row) { ?>
                                    <option value="<?= $row['customer'] . '   |   ' . $row['invoice_no'] . '   |   ' . $row['order_id'] . '   |   ' . date('F j, g:i A', strtotime($row['create_at'])) ?>">
                                    <?php } ?>
                                </datalist> --}}
                                
                                <button id="add-ons" title="Add-ons" class="border rounded-r-full pr-3 border-gray-500 hover:border-gray-50 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-left">
                    <div id="opField2" class="flex ml-2">
                        <div>
                            <label for="Service type" class="font-semibold text-xs">TYPE</label>
                            <div class="flex items-center hover:cursor-pointer">
                                <input id="horizontal-list-radio-license" checked type="radio" value="DN" title="Dine in" name="service" title="Dine in" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-rose-600 checked:border-rose-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left cursor-pointer">
                                <label for="horizontal-list-radio-license" title="Dine in" class="px-2 text-base font-bold text-gray-900 dark:text-gray-800 hover:cursor-pointer">DN</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="flex items-center hover:cursor-pointer">
                                <input id="horizontal-list-radio-passport" type="radio" value="TK" name="service" title="Take out" class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-rose-600 checked:border-rose-600 focus:outline-none transition duration-200 cursor-pointer">
                                <label for="horizontal-list-radio-passport" title="Take out" class="font p-2 text-base font-bold text-gray-900 dark:text-gray-800 hover:cursor-pointer">TK</label>
                            </div>
                        </div>
                    </div>

                    <button id="refresh-table" title="Refresh | Cancel Order" class="ml-auto border border-gray-500 rounded-full hover:border-gray-50 mt-2 text-white font-medium hover:text-red-300 p-1 bg-gradient-to-r from-red-500 to-gray-700 rounded-full mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </button>

                    <!-- print receipt -->
                    <button id="print-receipt" title="print receipt" class="ml-auto whitespace-nowrap border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-2 flex px-3 py-1 mr-3 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                        &nbsp; Print
                    </button>

                    <!-- place order -->
                    <button id="send-request" title="Place order" class="hidden whitespace-nowrap ml-auto border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-2 flex px-3 py-1 mr-3 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M10.5 8.25h3l-3 4.5h3" />
                        </svg>
                        &nbsp; Place
                    </button>
                </div>

            </div>
        </div>
    </section>
    <x-slot:scripts>
        <script src="{{ asset('js/menu.js') }}"></script> 
        </script> 
    </x-slot:scripts>
</x-layout.app>