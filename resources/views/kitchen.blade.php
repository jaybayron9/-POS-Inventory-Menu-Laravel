<x-layout.app>
    <x-layout.navbar />
    <div class="h-screen bg-gray-200">
        <section class="mx-auto"> 
            @if ($haveOrders)
                <div class="p-4">
                    <div class="grid xl:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-3 mb-4"> 
                        @foreach ($orders as $order)
                            <div class="relative shadow-xl rounded overflow-y-auto overflow-x-auto p-2 bg-gray-50" style="max-height: 380px;">
                                <table class="text-sm text-left w-full">
                                    <div class="relative">
                                        <!-- Check -->
                                        <a data-row-data="<?= $order->order_id ?>" title="Done Order" class="done hover:cursor-pointer duration-200 absolute right-0 top-0 text-green-500 bg-white hover:text-green-400 hover:bg-gray-100 p-1 rounded-full text-8xl border border-gray-200 shadow">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                                                <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
    
                                        <!-- Cancel Order -->
                                        <?php if (strpos($order->product_name, '+') === false) {  ?>
                                            <a data-row-data="<?= $order['order_id'] ?>" title="Cancel Order" class="cancel hover:cursor-pointer duration-200 absolute right-1 top-12 text-red-500 bg-white hover:text-red-400 hover:bg-gray-100 p-1 rounded-full border border-gray-200 shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                </svg>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <thead class="text-xs text-gray-700 bg-gray-50 ">
                                        <div class="grid border-b border-gray-300 grid-cols-3 gap-1 px-2 py-1  pr-8 whitespace-nowrap text-center bg-blue-100">
                                            <p title="Customer name" class="font-medium capitalize">
                                            <?= $order->customer_name !== '' ? $order->customer_name : $order->invoice_no ?>
                                            </p>
                                            <p title="Customer name" class="rounded px-5 flex bg-gradient-to-r <?= $order->service_type == 'TK' ? 'from-blue-400 to-blue-700' : 'from-orange-400 to-orange-700' ?> font-bold text-white capitalize">
                                                <?= $order->service_type == 'DN' ? 'DN' : 'TK'  ?>
                                            </p>
                                            <p title="Time ordered" class="font-medium capitalize">
                                                <?= date("g:i a", strtotime($order->created_at))  ?>
                                            </p>
                                        </div>
                                        <div class="pb-1 border-b border-gray-200">
                                            <p title="Message" class="pb-2 text-gray-900">
                                                <span class="font-medium text-sm">Note: &nbsp;&nbsp;&nbsp; </span>  <?= $order->note  ?>
                                                <?= strpos($order->product_name, '+') !== false ? '<span class="text-blue-600 border-2 border-blue-500 font-medium px-1 whitespace-nowrap">Add-ons</span>' : ''; ?>
                                            </p>
                                        </div>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $fname = explode(", ", $order->product_name);
                                        $name = array_filter($fname);
    
                                        $fquantity  = array_map('intval', explode(", ", $order->quantity));
                                        $quantity = array_filter($fquantity);
                                        
                                        for ($i = 0; $i < count($name); $i++) {
                                            $cookieProductName = str_replace(' ', '', $name[$i]);
                                            if (strpos($order->product_name, '+') !== false) {
                                            ?>
                                                <tr class="<?= $no % 2 !== 0 ? 'bg-gray-200' : '' ?> border-b hover:bg-green-200 capitalize">
                                                    <th scope="row" class="px-1 font-light hidden"><?= $no++ ?></th>
                                                    <th scope="row" class="px-1 font-light"><input type="checkbox" id="<?= $cookieProductName . $order->order_id . $quantity[$i] ?>"></th>
                                                    <th scope="row" class="<?= strpos($name[$i], '+') !== false ? '' : 'line-through decoration-2 decoration-double decoration-red-500' ?> pl-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                        <?= str_replace('+', '<span class=" bg-blue-500 px-1 rounded-full mr-1 font-extrabold text-1x text-white">+</span>', $name[$i]); ?>
                                                    </th>
                                                    <th scope="row" class="<?= strpos($name[$i], '+') !== false ? '' : 'line-through decoration-2 decoration-double decoration-red-500' ?> px-6 py-1 font-medium text-gray-900 text-right">
                                                        <?= $quantity[$i] ?>x
                                                    </th>
                                                </tr>
                                            <?php 
                                            } else {
                                                ?>
                                                <tr class="<?= $no % 2 !== 0 ? 'bg-gray-200' : '' ?> border-b hover:bg-green-200 capitalize">
                                                    <th scope="row" class="px-1 font-light hidden"><?= $no++ ?></th>
                                                    <th scope="row" class="px-1 font-light"><input type="checkbox" id="<?= $cookieProductName . $order->order_id . $quantity[$i]  ?>"></th>
                                                    <th scope="row" class="pl-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                        <?= $name[$i] ?>
                                                    </th>
                                                    <th scope="row" class="px-6 py-1 font-medium text-gray-900 text-right">
                                                        <?= $quantity[$i] ?>x
                                                    </th>
                                                </tr>
                                                <?php
                                            }
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="flex justify-center h-screen">
                    <p class="m-auto text-5xl font-bold text-gray-300">No Orders</p>
                </div>
            @endif
        </section>
    </div>
    <x-slot:scripts> 
        <script type="text/javascript">
            $('.done').click(function() {
                swal({
                        title: "Is this order ready to be served?",
                        icon: "warning",
                        buttons: ["No", "Yes"],
                    })
                    .then((willDone) => {
                        if (willDone) {
                            $.ajax({
                                type: "GET",
                                url: `/order/serve/${$(this).data('row-data')}`, 
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) { 
                                    console.log(response);
                                    if (response.status == 'success') {
                                        location.reload() 
                                    } else {
                                        swal({
                                            title: "Error",
                                            text: response.msg,
                                            icon: "error",
                                            confirmationbutton: true,
                                            dangerMode: true,
                                        }).then(() => { location.reload() });
                                    }
                                }
                            });
                        } 
                    });
            });

            $('.cancel').click(function() {
                swal({
                        title: "Do you want to cancel this order?",
                        icon: "warning",
                        buttons: ["No", "Yes"],
                        dangerMode: true,
                    })
                    .then((willDone) => {
                        if (willDone) { 
                            $.ajax({
                                type: "GET",
                                url: `/order/cancel/${$(this).data('row-data')}`, 
                                success: function(response) {
                                    if (response.status == 'success') {
                                        location.reload();
                                    } else {
                                        swal({
                                            title: "Error",
                                            text: response.msg,
                                            icon: "error",
                                            confirmationbutton: true,
                                            dangerMode: true,
                                        }).then(() => { location.reload() });
                                    }
                                }
                            });
                        }
                    });
            });

            $.ajax({
                url: "index.php?a=ring_notif",
                dataType: "json",
                success: function(resp) {
                    if (resp.status == 'success') {
                        $('#notificationSound')[0].play();
                        setInterval(function() {
                            $.ajax({
                                url: "index.php?a=pause_bell",
                                dataType: "json",
                                success: function(resp) {
                                    if (resp.status == 'success') {
                                        $('#notificationSound')[0].pause();
                                    }
                                }
                            })
                        }, 5000);
                    }
                }
            });

            setInterval(function() {
                location.reload();
            }, 12000);

            function getCookie(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                
                if (parts.length === 2) {
                    return parts.pop().split(";").shift();
                }
                return "";
            }

            $('input[type=checkbox]').click(function() {
                var name = $(this).attr('id');
                var value = $(this).prop('checked');

                document.cookie = name + "=" + value;
            });

            $('input[type=checkbox]').each(function() {
                var name = $(this).attr('id');
                var value = getCookie(name);

                if (value !== "") {
                    $(this).prop('checked', value === "true");
                }
            });
        </script>
    </x-slot:scripts>
</x-layout.app>