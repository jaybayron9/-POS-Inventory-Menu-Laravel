<x-layout.app>
    <x-slot:links>
        <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/table.css') }}" rel="stylesheet" />
    </x-slot:links>
    <x-layout.navbar />

    <section class="container mx-auto">
        <div class="bg-white p-4 rounded shadow-md mb-5 mt-8">
            <div class="flex flex-wrap gap-4">
                <div class="flex ">
                    <label for="search_date" class="block mt-1 font-medium">DATE :&nbsp;</label>
                    <input type="date" id="search_date" name="date" class="border-none p-1">
                </div>
            </div>
            <table id="historytbl" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th data-priority="1" class="text-xs">ID.</th>
                        <th data-priority="2" class="text-xs">TABLE</th>
                        <th data-priority="14" class="text-xs">PURCHASED</th>
                        <th data-priority="3" class="text-xs">TOTAL</th>
                        <th data-priority="4" class="text-xs">DISCOUNT</th>
                        <th data-priority="5" class="text-xs">AMOUNT DUE</th>
                        <th data-priority="6" class="text-xs">CASH</th>
                        <th data-priority="7" class="text-xs">BALANCE</th>
                        <th data-priority="8" class="text-xs">SERVICE TYPE</th>
                        <th data-priority="9" class="text-xs">ORDER STATUS</th>
                        <th data-priority="8" class="text-xs">PAYMENT STATUS</th>
                        <th data-priority="10" class="text-xs">RECEIPT</th>
                        <th data-priority="11" class="text-xs">CREATED</th>
                        <th data-priority="12" class="text-xs">UPDATED</th>
                        <th data-priority="13" class="text-xs hidden">DATE</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($orders as $cust)  
                        <tr>
                            <td class="text-gray-700"><?= $cust->invoice_no ?></td>
                            <td class="capitalize whitespace-nowrap"><?= $cust->customer_name !== '' ? $cust->customer_name : $cust->invoice_no ?></td>
                            <td>
                                <?php
                                $name = array_filter(explode(", ", $cust->product_name));
                                $price = array_filter(explode(", ", $cust->unit_price));
                                $quantity = array_filter(explode(", ", $cust->quantity));

                                for ($i = 0; $i < count($name); $i++) {
                                    echo "<span class='bg-gray-200 rounded-l m-0 px-2 shadow '>"
                                        . $name[$i] .
                                        "</span>";
                                    echo "<span class='m-0 px-1 bg-sky-300 shadow'>"
                                        . $quantity[$i] .
                                        "</span>";
                                    if (empty($price[$i])) {
                                        echo "<span class='rounded-r m-0 px-1 bg-green-300 shadow'></span>";
                                    } else {
                                        echo "<span class='rounded-r m-0 px-1 bg-green-300 shadow'>"
                                            . $price[$i] .
                                            "</span>";
                                    }
                                    echo "<span class='text-red-700 m-1'></span>";
                                }
                                ?>
                            </td>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($cust->total_amount, 2) ?>
                            <td class="whitespace-nowrap"><span class="text-red-600">-</span> <?= number_format($cust->discount_percent, 2) ?>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($cust->total_discount_amount, 2) ?>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= $cust->payment_amount ?>
                            <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= $cust->pay_change < $cust->total_amount ? number_format($cust->payment_change, 2) : 0 ?>
                            <td>
                                <div class="font-medium bg-gradient-to-r <?= $cust->service_type == "TK" ? 'from-blue-400 to-gray-700' : 'from-orange-400 to-orange-700' ?> px-1 text-white rounded text-center whitespace-nowrap">
                                    <?= $cust->service_type == "TK" ? 'TAKE OUT' : 'DINE IN' ?>
                                </div>
                            </td>
                            <td>
                                <div class="font-medium bg-gradient-to-r <?= $cust->order_status == "" ? 'from-green-400 to-green-700' : 'from-rose-400 to-rose-700' ?> px-1 text-white rounded text-center whitespace-nowrap">
                                    <?= $cust->order_status == "" ? 'PENDING' : 'SERVED' ?>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="font-medium bg-gradient-to-r <?= $cust->payment_status == "Paid" ? 'from-sky-400 to-sky-700' : 'from-gray-400 to-gray-500' ?> px-1 text-white rounded text-center whitespace-nowrap uppercase">
                                    <?= $cust->payment_status ?>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <a data-modal-target="receipt-modal" data-modal-toggle="receipt-modal" data-modal-toggle="receipt-modal" data-row-data="<?= $cust->total_amount . ', ' . $cust->order_id ?>" class="row bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    Receipt
                                </a>
                                @if( $cust->payment_status == 'Paid' or $cust->payment_status == 'Balance' ) 
                                    <a data-row-data="<?= $cust->order_id ?>" class="reissue-receipt bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 whitespace-nowrap hover:cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        Reissue
                                    </a>
                                @endif
                            </td>
                            <td class="whitespace-nowrap">
                                <?= date('g: i a', strtotime($cust->created_at))?>
                                </td>
                                <td class="whitespace-nowrap">
                                <?= date('g: i a', strtotime($cust->updated_at)) ?>
                            </td>
                            <td class="whitespace-nowrap hidden"><?= date('Y-m-d', strtotime($cust->created_at)) ?></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <div id="receipt-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-md h-full md:h-auto ">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between px-4 pt-4 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Order Receipt
                    </h3>
                    <button id="x-button" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="receipt-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-6 pb-5 pt-1 space-y-6">
                    <input type="hidden" id="order_id">
    
                    <div class="mb-2 flex">
                        <p>Total : <span class="text-green-500">₱</span> <span id="total"></span></p>
                        <p id="discoutotal" class="ml-auto hidden">Total Discount : <span class="text-green-500">₱</span> <span id="finaltotal"></span></p>
                    </div>
    
                    <div class="flex items-center justify-center gap-3">
                        <div>
                            <label for="Payment amount" class="font-semibold text-xs">PAYMENT</label>
                            <input type="text" id="payment-amount" name="payment_amount" title="Payment amount" data-row-data="1" placeholder="0" maxlength="11" class="payment w-full rounded-l-md border-gray-400 shadow-md text-green-700 myInput placeholder:text-green-500 py-1" list="paymenttList">
                            <datalist id="paymenttList">
                                <option id="op-pay" value="">
                            </datalist>
                        </div>
    
                        <div>
                            <label for="Change" class="font-semibold text-xs">CHANGE</label>
                            <input type="number" id="change" name="change" disabled title="Change" placeholder="0" class="w-full px-2 rounded-r-md border-gray-300 bg-gray-100 shadow-md text-red-500 placeholder:text-red-500 py-1">
                        </div>
    
                        <div>
                            <label for="Discount" class="font-semibold text-xs">%&nbsp;DISCOUNT</label>
                            <input type="text" id="discount" name="discount" title="Discount" placeholder="0" maxlength="5" class="discount w-full rounded-l-md border-gray-400 shadow-md text-green-700 myInput placeholder:text-green-500 py-1" list="discountList">
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
                    <button id="print-receipt" title="print receipt" class="ml-auto whitespace-nowrap border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-5 flex px-4 py-1 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                        PRINT RECEIPT
                    </button>
                </div>
            </div>
        </div>
    </div> 

    <x-slot:scripts>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
        <script type="text/javascript"> 
            $('#print-receipt').click(function(e) {
                e.preventDefault();
                var payment = $('#payment-amount').val();
    
                if(payment == '' || payment == 0) {
                    return swal({
                        title: "Payment amount is required",
                        icon: "warning",
                        button: "OK",
                    })
                }
                
                $.ajax({
                    url: '/update/receipt',
                    type: 'POST',
                    data: {
                        order_id: $('#order_id').val(),
                        total: $('#total').html(),
                        payment_amount: $('#payment-amount').val(),
                        change: $('#change').val(),
                        discount: $('#discount').val(),
                        discount_amount: $('#discountamount').val(),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        console.log(resp);
                        var iframe = "<iframe src='/show/receipt' style='display: none;' ></iframe>";
                        $("body").append(iframe);
                        var iframeElement = document.querySelector("iframe");
                        iframeElement.contentWindow.print();
                    }
                });
            });

            $('#change').val('0.00');
            $('#discountamount').val('0.00');
            $('#payment-amount').on('input', function() {
                change();
            });

            // event listener to discount field
            $('#discount').on('input', function() {
                if ($(this).val() > 0) {
                    $('#discoutotal').removeClass('hidden');
                } else {
                    $('#discount').val(0);
                    $('#discoutotal').addClass('hidden');
                }
    
                if (parseFloat($("#discount").val()) >= 100) {
                    swal({
                        title: "Error!",
                        text: "Discount must be below than 100",
                        icon: "error",
                        button: "Ok",
                    })
                }
    
                discounted();
                updateTotal();
            });
    
            $('#discount').on('focus', function() {
                if ($(this).val() == '0') {
                    $(this).val('');
                }
            }).on('blur', function() {
                if ($(this).val() == '') {
                    $(this).val('0');
                }
            });
    
            // validation for number field
            $('.myInput').on('keydown keyup', function(event) {
                var input = $(this);
                var value = input.val();
    
                value = value.replace(/[^0-9\.]/g, '');
    
                var decimalCount = (value.match(/\./g) || []).length;
                if (decimalCount > 1) {
                    value = value.replace(/\.+$/, '');
                }
    
                input.val(value);
            });
    
    
            function discounted() {
                var total = parseFloat($('#total').html());
                var discount = parseFloat($('#discount').val());
                var payment = parseFloat($('#payment-amount').val());
    
                var discountAmount = total * (discount / 100);
                var NewTotal = total - discountAmount;
                var NewChange = payment - NewTotal;
    
                $('#discountamount').val(discountAmount.toFixed(2));
                $('#finaltotal').html(NewTotal.toFixed(2));
                $('#change').val(NewChange.toFixed(2));
            }
    
            // change
            function change() {
                if ($('#finaltotal').html() == '') {
                    $('#change').val(parseFloat($('#payment-amount').val()).toFixed(2) - parseFloat($('#total').html()).toFixed(2));
                } else {
                    $('#change').val(parseFloat($('#payment-amount').val()).toFixed(2) - parseFloat($('#finaltotal').html()).toFixed(2));
                }
            }
    
            $(document).keydown(function(event) {
                if (event.which == 27) {
                    // Your code to handle the escape key event goes here
                    window.location.reload(true);
                }
            });
    
            $('#x-button').click(function() {
                window.location.reload(true);
            }); 
        </script>
        <script type="text/javascript"> 
            var table = $('#historytbl').DataTable({
                // "lengthMenu": [20, 100, 200, 300, 500, 1000],
                "paging": false,
                responsive: true,
                columns: [
                    { title: 'ID.' },
                    { title: 'TABLE' },
                    { title: 'PURCHASED' },
                    { title: 'SUBTOTAL' },
                    { title: 'DISCOUNT' },
                    { title: 'TOTAL DUE' },
                    { title: 'CASH' },
                    { title: 'BALANCE & CHANGE' },
                    { title: 'SERVICE TYPE' },
                    { title: 'ORDER STATUS' },
                    { title: 'PAYMENT STATUS' },
                    { title: 'RECEIPT' },
                    { title: 'CREATED' },
                    { title: 'UPDATED' },
                    { title: 'DATE' },
                ],
                initComplete: function () {
                    $('#historytbl_filter input').attr('maxlength', 35);
                }
            })
            .columns.adjust()
            .responsive.recalc();

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var searchDate = $('#search_date').val();
                    var date = data[14]; // assuming the date is in the first column
                    if (searchDate === '') {
                        return true;
                    }
                    if (date === searchDate) {
                        return true;
                    }
                    return false;
                }
            );

            $('#search_date').on('change', function() {
                table.draw();
            });

            var today = new Date().toISOString().substr(0, 10);
            $('#search_date').val(today);
            table.draw();

            $('.row').click(function() {
                var data = $(this).data('row-data');
                var values = data.split(",");

                var total_discount = parseInt(values[0]);
                var secondValue = parseInt(values[1]);

                $('#total').html(Number(total_discount).toFixed(2));
                $('#order_id').val(secondValue);
                $('#op-pay').val(Number(total_discount).toFixed(2));
            });

            var printDialogClosed = false;
            $('.reissue-receipt').click(function() {
                $.ajax({
                    url: '/reissue/receipt',
                    type: 'POST',
                    data: {
                        order_id: $(this).data('row-data'),
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        var iframe = "<iframe src='/show/receipt' style='display: none;' ></iframe>";
                        $("body").append(iframe);
                        var iframeElement = document.querySelector("iframe");
                        iframeElement.contentWindow.print();
                        setTimeout(checkPrintDialogClosed, 2000);
                    }
                })
            });

            window.onbeforeprint = function () {
                printDialogClosed = false;
            }
            window.onafterprint = function () {
                printDialogClosed = true;
            }
            function checkPrintDialogClosed() {
                if (!printDialogClosed) {
                    alert('Press Enter to Continue.');
                    $.ajax({
                        url: 'index.php?h=unset_receipt',
                        success: function(data) {
                            window.location.reload();
                        }
                    });
                }
            }
        </script>
    </x-slot:scripts>
</x-layout.app>