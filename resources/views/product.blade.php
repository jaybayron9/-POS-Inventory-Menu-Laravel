<x-layout.app>
    <x-slot:links>
        <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/table.css') }}" rel="stylesheet" />
    </x-slot:links>
    <x-layout.navbar />

    <section class="container mx-auto px-5">
        <div class="bg-white p-4 rounded shadow-md mb-5 mt-5">
            <div class="flex gap-4 mb-3">
                <button data-dropdown-toggle="category" data-dropdown-trigger="click" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">
                    @php
                        if (!empty($_GET)) {
                            echo $category = match ($_GET['category']) {
                                'meals' => 'Meals',
                                'drinks' => 'Drinks',
                                'add-ons' => 'Add-ons', 
                                'supplies' => 'Supplies'
                            };
                        } else {
                            echo $category = 'Meals';
                        }  
                    @endphp
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="category" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
                    <ul class="py-2 text-sm text-gray-700 text-gray-800" aria-labelledby="dropdownHoverButton">
                        <li>
                            <a href="?category=meals" id="mealsbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Meals</a>
                        </li>
                        <li>
                            <a href="?category=drinks" id="drinksbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Drinks</a>
                        </li>
                        <li>
                            <a href="?category=add-ons" id="drinksbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Add-ons</a>
                        </li>
                        <li>
                            <a href="?category=supplies" id="suppliesbtn" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Supplies</a>
                        </li>
                    </ul>
                </div>

                <button id="" class="modal-open add-product ml-auto rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 text-center inline-flex items-center border border-gray-500 hover:border-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Product
                </button>

                <button data-dropdown-toggle="report" data-dropdown-trigger="click" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">Report
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="report" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 bg-gray-100">
                    <ul class="py-2 text-sm text-gray-700 text-gray-800" aria-labelledby="dropdownHoverButton">
                        <li>
                            <a href="#" id="exportpdf" data-row-data="<?= $category ?>" class="flex block px-8 py-2 hover:bg-gray-600 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                PDF
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="?p=product-history" class="rounded-md flex bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-rose-400" type="button">
                    History
                </a>

                <a href="#" id="delete-row" title="Delete row" class="bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </a>

                <a href="#" title="clear sale" class="reset-sale bg-gradient-to-r p-1 px-1 from-red-500 to-gray-700 text-white hover:text-red-200 rounded-full border border-gray-500 hover:border-rose-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </a>
            </div>

            <div id="pdf-view">
                <table id="category-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>
                            <th data-priority="1" class="text-xs"></th>
                            <th data-priority="2" class="text-xs"></th>
                            <th data-priority="3" class="text-xs">NAME</th>
                            <th data-priority="6" class="text-xs">STATUS</th>
                            <th data-priority="5" class="text-xs">PRICE</th>
                            <th data-priority="7" class="text-xs">QUANTITY</th>
                            <th data-priority="7" class="text-xs">ON HAND</th>
                            <th data-priority="8" class="text-xs">REORDER LEVEL</th>
                            <th data-priority="9" class="text-xs">TOTAL</th>
                            <th data-priority="10" class="text-xs">SALE</th>
                            <th data-priority="11" class="text-xs">CREATED</th>
                            <th data-priority="12" class="text-xs">UPDATED</th>
                            <th data-priority="4" class="text-xs">ACTION</th>
                            <th data-priority="13" class="text-xs">DESCRIPTION</th>
                        </tr>
                    </thead>
                    @php $id = 0; @endphp
                    @if (empty($_GET) || $_GET['category'] === 'meals') 
                        <tbody>  
                            @foreach ($products('meals') as $meal)
                                <tr>
                                    <td><?= $id++ ?></td>
                                    <td class="text-center">
                                    <input type="checkbox" data-row-data="<?= $meal->product_id ?>" id="" class="select" value="<?= $meal->product_id ?>">
                                    </td>
                                    <td class="flex ml-4">
                                        <img src="/storage/uploads/<?= $meal->picture !== Null ? $meal->picture : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                        <p class="pt-2 ml-2 capitalize"><?= $meal->product_name ?></p>
                                    </td>
                                    <td class="text-center">
                                        <select data-row-data="<?= $meal->product_id ?>" class="status-product">
                                            <option value="" selected hidden><?= $meal->status !== '' ? $meal->status : 'Status' ?></option>
                                            <option value="Available">Available</option>
                                            <option value="Unavailable">Unavailable</option>
                                        </select>
                                    </td>
                                    <td><span class="text-green-600">₱</span> <?= $meal->price ?></td>
                                    <td><?= $meal->original_quantity ?></td>
                                    <td class="<?= $meal->current_quantity <= $meal->reorder_level ? 'text-red-500' : '' ?>"><?= $meal->current_quantity ?></td>
                                    <td><input type="text" value="<?= $meal->reorder_level ?>" data-row-data="<?= $meal->product_id ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                                    <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($meal->total_amount) ?></td>
                                    <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($meal->sale_amount) ?></td>
                                    <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($meal->created_at)) ?></td>
                                    <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($meal->updated_at)) ?></td>
                                    <td class="whitespace-nowrap">
                                        <a data-modal-toggle="in-modal" data-modal-target="in-modal" data-row-data="<?= $meal->product_id ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                            IN
                                        </a>
                                        <a data-modal-toggle="out-modal" data-modal-target="out-modal" data-row-data="<?=$meal->product_id ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                            OUT
                                        </a>
                                        <a data-row-data="<?= $meal->product_id ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                            EDIT
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        $ing = array_filter(explode(", ", $meal->note));
    
                                        for ($i = 0; $i < count($ing); $i++) {
                                            echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>  
                    @elseif ($_GET['category'] === 'drinks')
                        @foreach ($products('drinks') as $drink)
                            <tr>
                                <td><?= $id++ ?></td>
                                <td class="text-center">
                                <input type="checkbox" data-row-data="<?= $drink->product_id ?>" id="" class="select" value="<?= $drink->product_id ?>">
                                </td>
                                <td class="flex ml-4">
                                    <img src="/storage/uploads/<?= $drink->picture !== Null ? $drink->picture : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                    <p class="pt-2 ml-2 capitalize"><?= $drink->product_name ?></p>
                                </td>
                                <td class="text-center">
                                    <select data-row-data="<?= $drink->product_id ?>" class="status-product">
                                        <option value="" selected hidden><?= $drink->status !== '' ? $drink->status : 'Status' ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= $drink->price ?></td>
                                <td><?= $drink->original_quantity ?></td>
                                <td class="<?= $drink->current_quantity <= $drink->reorder_level ? 'text-red-500' : '' ?>"><?= $drink->current_quantity ?></td>
                                <td><input type="text" value="<?= $drink->reorder_level ?>" data-row-data="<?= $drink->product_id ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                                <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($drink->total_amount) ?></td>
                                <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($drink->sale_amount) ?></td>
                                <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($drink->created_at)) ?></td>
                                <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($drink->updated_at)) ?></td>
                                <td class="whitespace-nowrap">
                                    <a data-modal-toggle="in-modal" data-row-data="<?= $drink->product_id ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        IN
                                    </a>
                                    <a data-modal-toggle="out-modal" data-row-data="<?=$drink->product_id ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        OUT
                                    </a>
                                    <a data-row-data="<?= $drink->product_id ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        EDIT
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $ing = array_filter(explode(", ", $drink->note));

                                    for ($i = 0; $i < count($ing); $i++) {
                                        echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                    }
                                    ?>
                                </td>
                            </tr> 
                        @endforeach
                    @elseif ($_GET['category'] === 'add-ons')
                        @foreach ($products('add-ons') as $add_ons)
                            <tr>
                                <td><?= $id++ ?></td>
                                <td class="text-center">
                                <input type="checkbox" data-row-data="<?= $add_ons->product_id ?>" id="" class="select" value="<?= $add_ons->product_id ?>">
                                </td>
                                <td class="flex ml-4">
                                    <img src="/storage/uploads/<?= $add_ons->picture !== Null ? $add_ons->picture : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                    <p class="pt-2 ml-2 capitalize"><?= $add_ons->product_name ?></p>
                                </td>
                                <td class="text-center">
                                    <select data-row-data="<?= $add_ons->product_id ?>" class="status-product">
                                        <option value="" selected hidden><?= $add_ons->status !== '' ? $add_ons->status : 'Status' ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= $add_ons->price ?></td>
                                <td><?= $add_ons->original_quantity ?></td>
                                <td class="<?= $add_ons->current_quantity <= $add_ons->reorder_level ? 'text-red-500' : '' ?>"><?= $add_ons->current_quantity ?></td>
                                <td><input type="text" value="<?= $add_ons->reorder_level ?>" data-row-data="<?= $add_ons->product_id ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                                <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($add_ons->total_amount) ?></td>
                                <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($add_ons->sale_amount) ?></td>
                                <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($add_ons->created_at)) ?></td>
                                <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($add_ons->updated_at)) ?></td>
                                <td class="whitespace-nowrap">
                                    <a data-modal-toggle="in-modal" data-row-data="<?= $add_ons->product_id ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        IN
                                    </a>
                                    <a data-modal-toggle="out-modal" data-row-data="<?=$add_ons->product_id ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        OUT
                                    </a>
                                    <a data-row-data="<?= $add_ons->product_id ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        EDIT
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $ing = array_filter(explode(", ", $add_ons->note));

                                    for ($i = 0; $i < count($ing); $i++) {
                                        echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        @endforeach 
                    @elseif ($_GET['category'] === 'supplies')
                        @foreach ($products('supplies') as $supply)
                            <tr>
                                <td><?= $id++ ?></td>
                                <td class="text-center">
                                <input type="checkbox" data-row-data="<?= $supply->product_id ?>" id="" class="select" value="<?= $supply->product_id ?>">
                                </td>
                                <td class="flex ml-4">
                                    <img src="/storage/uploads/<?= $supply->picture !== Null ? $supply->picture : 'default.jpg' ?>" alt="Product image" class="h-10 w-10 rounded-full">
                                    <p class="pt-2 ml-2 capitalize"><?= $supply->product_name ?></p>
                                </td>
                                <td class="text-center">
                                    <select data-row-data="<?= $supply->product_id ?>" class="status-product">
                                        <option value="" selected hidden><?= $supply->status !== '' ? $supply->status : 'Status' ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </td>
                                <td><span class="text-green-600">₱</span> <?= $supply->price ?></td>
                                <td><?= $supply->original_quantity ?></td>
                                <td class="<?= $supply->current_quantity <= $supply->reorder_level ? 'text-red-500' : '' ?>"><?= $supply->current_quantity ?></td>
                                <td><input type="text" value="<?= $supply->reorder_level ?>" data-row-data="<?= $supply->product_id ?>" class="reorder myInput bg-gray-50 w-20 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block px-2 py-1 text-center"></td>
                                <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($supply->total_amount) ?></td>
                                <td class="whitespace-nowrap"><span class="text-green-600">₱</span> <?= number_format($supply->sale_amount) ?></td>
                                <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($supply->created_at)) ?></td>
                                <td class="whitespace-nowrap"><?= date('F j, Y', strtotime($supply->updated_at)) ?></td>
                                <td class="whitespace-nowrap">
                                    <a data-modal-toggle="in-modal" data-row-data="<?= $supply->product_id ?>" class="in flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        IN
                                    </a>
                                    <a data-modal-toggle="out-modal" data-row-data="<?=$supply->product_id ?>" class="out flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        OUT
                                    </a>
                                    <a data-row-data="<?= $supply->product_id ?>" class="modal-open update-product flex bg-gradient-to-r from-gray-500 to-gray-700 text-gray-50 hover:text-gray-200 font-medium text-sm px-3 py-1 text-center inline-flex items-center border border-gray-500 hover:border-gray-100 hover:cursor-pointer">
                                        EDIT
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $ing = array_filter(explode(", ", $supply->note));

                                    for ($i = 0; $i < count($ing); $i++) {
                                        echo "<span class='bg-gray-200 capitalize rounded-md m-1 px-1 font-semibold text-gray-700'>" . $ing[$i] . "</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        @endforeach 
                    @endif
                </table>
            </div>
        </div>
    </section>

    <div class="modal opacity-0 z-50 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-white opacity-95"></div>
    
        <div class="modal-container fixed w-full h-full z-50 overflow-y-auto">
    
            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                (Esc)
            </div> 
            <div class="modal-content container mx-auto h-auto text-left p-4"> 
                <div class="flex justify-between items-center pb-2">
                    <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-700 to-gray-900">HotPlate</p>
                </div> 
                <div class="flex items-center justify-center">
                    <form id="product-form" enctype="multipart/form-data">
                        <input type="hidden" id="id" name="id" value="">
                        <h1 id="title-form" class="col-span-2 text-2xl font-semibold mb-2 text-center">Add Product</h1>
                        <div class="mb-2">
                            <label for="product" class="">Product Name</label>
                            <input type="text" name="product" id="product" maxlength="50" class="w-full rounded-md" required>
                        </div>
                        <div class="mb-2">
                            <label for="Price">Price</label>
                            <input type="text" name="price" id="price" maxlength="11" class="w-full rounded-md myInput" required>
                        </div>
                        <div class="mb-2">
                            <label for="category">Category</label>
                            <select type="text" name="category" id="category" class="w-full rounded-md">
                                <option value="meals">Meals</option>
                                <option value="drinks">Drinks</option>
                                <option value="add-ons">Add-ons</option>
                                <option value="supplies">Supplies</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" maxlength="70" cols="30" rows="1" class="w-full rounded-md p-2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Product image">Upload image</label>
                            <input type="file" name="image" id="" accept="image/*" class="rounded-md bg-blue-300 w-full font-semibold">
                        </div>
                        <div class="mb-4">
                            <img id="img-con" src="" alt="product image" class="h-44 w-full rounded-md">
                        </div>
                        <!--Footer-->
                        <div class="col-span-2 flex justify-end pt-2 bottom-0">
                            <button id="removebtn" type="submit" class="px-4 bg-red-500 p-3 rounded-lg text-white hover:bg-red-400 hover:text-white mr-auto">Remove Photo</button>
                            <button id="savebtn" type="submit" class="savebtn px-4 bg-transparent p-3 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-400 mr-2">Save</button>
                            <button id="updatebtn" type="submit" class="updatebtn px-4 bg-transparent p-3 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-400 mr-2">Update</button>
                            <a href="#" class="modal-close px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="in-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-md h-full md:h-auto ">
            <!-- Modal content -->
            <div class="relative bg-white rounded shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between px-4 pt-4 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        IN STOCK
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="in-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-6 pb-5">
                    <form id="in-form" class="flex items-center justify-center gap-3">
                        <input type="hidden" id="in_product_id" name="product_id">
                        <input type="text" id="in" name="in" title="in" data-row-data="1" maxlength="5" class="payment w-full rounded border-gray-400 shadow-md text-green-700 myInput py-1 mt-5 text-center">
                        <button type="submit" class="ml-auto whitespace-nowrap border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-5 flex px-4 py-1 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                            IN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="out-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="false" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-md h-full md:h-auto ">
            <!-- Modal content -->
            <div class="relative bg-white rounded shadow">
                <!-- Modal header -->
                <div class="flex items-start justify-between px-4 pt-4 rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        OUT STOCK
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="out-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-6 pb-5">
                    <form id="out-form" class="flex items-center justify-center gap-3">
                        <input type="hidden" id="out_product_id" name="product_id">
                        <input type="text" id="out" name="out" title="out" data-row-data="1" maxlength="5" class="payment w-full rounded border-gray-400 shadow-md text-green-700 myInput py-1 mt-5 text-center">
                        <button type="submit" class="ml-auto whitespace-nowrap border rounded-md border-gray-500 hover:border-gray-50 rounded-md mt-5 flex px-4 py-1 bg-gradient-to-r from-red-500 to-gray-700 text-white hover:text-red-200">
                            OUT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot:scripts>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
        <script type="text/javascript">
             $('#category-table').DataTable({
                initComplete: function () {
                    $('#historytbl_filter input').attr('maxlength', 35);
                },
                "paging": false,
                responsive: true,
                columns: [
                    { title: '#' },
                    { title: '<input type="checkbox" name="" id="selectAll">' },
                    { title: 'NAME' },
                    { title: 'STATUS' },
                    { title: 'PRICE' },
                    { title: 'QTY' },
                    { title: 'ON HAND' },
                    { title: 'REORDER LEVEL' },
                    { title: 'TOTAL' },
                    { title: 'SALE' },
                    { title: 'CREATED' },
                    { title: 'UPDATED' },
                    { title: 'ACTION' },
                    { title: 'DESCRIPTION' }
                ],
            }).columns.adjust().responsive.recalc();

            $('#selectAll').click(function() {
                $('.select').not(this).prop('checked', this.checked);
            });

            $('.status-product').change(function() {
                var id = $(this).data("rowData");
                var status = $(this).val();
                $.ajax({
                    url: 'index.php?a=status_product',
                    type: 'POST',
                    data: {
                        status: status,
                        id: id
                    },
                    dataType: 'json',
                    success: function(resp) {
                        swal({
                            icon: 'success',
                            text: resp.msg,
                            buttons: false,
                            timer: 1000
                        })
                    }
                });
            });

            $('.reorder').on('keyup', function() {
                $.ajax({
                    url: 'index.php?a=reorder_product',
                    type: 'POST',
                    data: {
                        product_id: $(this).data('row-data'),
                        reorder: $(this).val()
                    }
                });
            });

            $('.in').click(function() {
                var data = $(this).data('row-data');
                $('#in_product_id').val(data);
            });

            $('.out').click(function() {
                var data = $(this).data('row-data');
                $('#out_product_id').val(data);
            });

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

            $('.add-product').click(function() {
                $('#product').val('');
                $('#price').val('');
                $('#price').val('');
                $('#description').val('');
                $('.savebtn').removeClass('hidden');
                $('.updatebtn').addClass('hidden');
                $("#img-con").attr("src", "/storage/eximage/icon.jpg");
                $('#title-form').html('Add Product');
            });

            $('.update-product').click(function() {
                $('#title-form').html('Update Product');
                $('.savebtn').addClass('hidden');
                $('.updatebtn').removeClass('hidden');
                $.ajax({
                    url: 'index.php?a=data_product',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: $(this).data('row-data')
                    },
                    success: function(data) {
                        $('#product').val(data.name);
                        $('#price').val(data.price);
                        $('#id').val(data.product_id);
                        $('#category').val(data.category);
                        $('#description').val(data.description);
                        if (data.picture !== null) {
                            $("#img-con").attr("src", "public/storage/uploads/" + data.picture + "");
                        } else {
                            $("#img-con").attr("src", "public/storage/uploads/default.jpg");
                        }
                    }
                });
            });

            $('.status-product').change(function() {
                var id = $(this).data("rowData");
                var status = $(this).val();
                $.ajax({
                    url: 'index.php?a=status_product',
                    type: 'POST',
                    data: {
                        status: status,
                        id: id
                    },
                    dataType: 'json',
                    success: function(resp) {
                        swal({
                            icon: 'success',
                            text: resp.msg,
                            buttons: false,
                            timer: 1000
                        })
                    }
                });
            });

            // Reset sale
            $('.reset-sale').click(function(e) {
                e.preventDefault();
                $(this).addClass('animate-spin');
                swal({
                    title: "This action cannot be undone",
                    text: "Are you sure you want to proceed with resetting the sale?",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                }).then((willDone) => {
                    if (willDone) {
                        $.ajax({
                            url: 'index.php?a=reset_sale',
                            dataType: 'json',
                            success: function(resp) {
                                if (resp.status == 'success') {
                                    swal({
                                        icon: 'success',
                                        text: 'Sale reset',
                                        buttons: false,
                                        timer: 1000
                                    }).then(() => location.reload());
                                }
                            }
                        });
                    }
                    $(this).removeClass('animate-spin');
                });
            });

            $('#delete-row').click(function() {
                swal({
                    title: "Are you sure you want to delete this row(s)?",
                    text: "This action cannot be undone.",
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                }).then((willDone) => {
                    if (willDone) {
                        var checkboxes = $('.select');
                        var rowData = [];
                        checkboxes.each(function() {
                            if ($(this).is(':checked')) {
                                var data = $(this).data('row-data');
                                rowData.push(data);
                            }
                        });

                        $.ajax({
                            url: 'index.php?a=delete_row',
                            type: 'POST',
                            data: {
                                'data': rowData
                            },
                            dataType: 'json',
                            success: function(resp) {
                                if (resp.status == 'success') {
                                    swal({
                                        text: resp.msg,
                                        icon: "success",
                                        buttons: false,
                                        timer: 2000,
                                    }).then(() => {
                                        location.reload()
                                    });
                                } else {
                                    swal({
                                        text: resp.msg,
                                        icon: "error",
                                        buttons: false,
                                        timer: 2000,
                                    });
                                }
                            }
                        });
                    }
                });
            });

            $('#exportpdf').click(function() {
                var checkboxes = $('.select');
                var rowData = [];
                checkboxes.each(function() {
                    if ($(this).is(':checked')) {
                        var data = $(this).data('row-data');
                        rowData.push(data);
                    }
                });
                $.ajax({
                    url: 'index.php?a=product_report', 
                    type: 'POST',
                    data: {
                        'product_ids': rowData,
                        'category': $("#exportpdf").data('row-data'),
                    },
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            $('#pdf-view').html('<object data="pdf-inventory.php" type="application/pdf" class="w-full h-screen">');
                        } else {
                            swal({
                                text: resp.msg,
                                icon: resp.status,
                                buttons: false,
                                timer: 2000,
                            });
                        }
                    },
                });
            });

            // Modal
            var openmodal = document.querySelectorAll('.modal-open')
            for (var i = 0; i < openmodal.length; i++) {
                openmodal[i].addEventListener('click', function(event) {
                    event.preventDefault()
                    toggleModal()
                })
            }

            const overlay = document.querySelector('.modal-overlay')
            overlay.addEventListener('click', toggleModal)

            var closemodal = document.querySelectorAll('.modal-close')
            for (var i = 0; i < closemodal.length; i++) {
                closemodal[i].addEventListener('click', toggleModal)
            }

            document.onkeydown = function(evt) {
                evt = evt || window.event
                var isEscape = false
                if ("key" in evt) {
                    isEscape = (evt.key === "Escape" || evt.key === "Esc")
                } else {
                    isEscape = (evt.keyCode === 27)
                }
                if (isEscape && document.body.classList.contains('modal-active')) {
                    toggleModal()
                }
            };

            function toggleModal() {
                const body = document.querySelector('body')
                const modal = document.querySelector('.modal')
                modal.classList.toggle('opacity-0')
                modal.classList.toggle('pointer-events-none')
                body.classList.toggle('modal-active')
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#description').on('input', function() {
                    $(this).height(0);
                    $(this).height(this.scrollHeight);
                });
        
                $('#savebtn').click(function() {
                    $("#product-form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: 'index.php?a=add_product',
                            type: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal({
                                        title: "Success!",
                                        text: "Product added successfully",
                                        icon: "success",
                                        button: false,
                                        time: 1000,
                                    })
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 1100);
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Unable to save",
                                        icon: "error",
                                        button: "Ok",
                                    })
                                }
                            }
                        });
                    });
                });
        
                $('#updatebtn').click(function() {
                    $("#product-form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: 'index.php?a=update_product',
                            type: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal({
                                        title: "Success!",
                                        text: "Product updated successfully",
                                        icon: "success",
                                        button: false,
                                        time: 1000,
                                    }).then(()=>{
                                        location.reload(true);
                                    });
                                }
                            }
                        });
                    });
                });
        
                $('#removebtn').click(function() {
                    $("#product-form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: 'index.php?a=remove_picture',
                            type: 'POST',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(data) {
                                if (data.status == 'success') {
                                    swal({
                                        title: "Success!",
                                        text: "Picture removed successfully",
                                        icon: "success",
                                        button: false,
                                        time: 1000,
                                    }).then(()=>{ location.reload(true); });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Unable to remove picture",
                                        icon: "error",
                                        button: "Ok",
                                    })
                                }
                            }
                        });
                    });
                });
        
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
            });
        </script>
        <script type="text/javascript"> 
            $('#in-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'index.php?a=in_out',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            swal({
                                title: 'Success',
                                text: resp.msg,
                                icon: 'success',
                                button: false,
                                timer: 2000
                            }).then(() =>{ location.reload() });
                        } else {
                            swal({
                                title: 'Error',
                                text: resp.msg,
                                icon: 'error',
                                button: false,
                                timer: 2000
                            });
                        }
                    }
                });
            }); 
        </script>
        <script type="text/javascript"> 
            $('#out-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'index.php?a=in_out',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(resp) {
                        if (resp.status == 'success') {
                            swal({
                                title: 'Success',
                                text: resp.msg,
                                icon: 'success',
                                button: false,
                                timer: 2000
                            }).then(() => { location.reload() })
                        } else {
                            swal({
                                title: 'Error',
                                text: resp.msg,
                                icon: 'error',
                                button: false,
                                timer: 2000
                            });
                        }
                    }
                });
            }); 
        </script>
    </x-slot:scripts>
</x-layout.app>