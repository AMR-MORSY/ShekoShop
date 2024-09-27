<x-dashboard-layout>
    <h1 class="text-5xl m-3">Orders </h1>


    @if (isset($orders) or count($orders)>0)

    <table id="default-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Name
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
               
                <th>
                    <span class="flex items-center">
                       Last Name
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Mobile
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Email
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Shipping Address
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                       المنطقة
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th data-type="date" data-format="YYYY/DD/MM">
                    <span class="flex items-center">
                        Order Date
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order )
            <tr>
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$order->first_name}}</td>
                <td>{{$order->last_name}}</td>
                <td>{{$order->mobile}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->shipping_address}}</td>
                <td>{{$order->state->state_name}}</td>
                <td>{{$order->created_at}}</td>
            </tr>
                
            @endforeach
           
        </tbody>
    </table>

        
    @endif
   

    {{$orders->links()}}

    






    {{-- @push('script')
        <script type="module">
            const dataTable = new simpleDatatables.DataTable("#default-table", {
                caption: "Flowbite is an open-source library",
                classes: {
                    // add custom HTML classes, full list: https://fiduswriter.github.io/simple-datatables/documentation/classes
                    // we recommend keeping the default ones in addition to whatever you want to add because Flowbite hooks to the default classes for styles
                },
                footer: true, // enable or disable the footer
                header: true, // enable or disable the header
                // labels: {
                //     // add custom text for the labels, full list: https://fiduswriter.github.io/simple-datatables/documentation/labels
                // },
                // template: (options, dom) => {


                // },
                scrollY: "300px", // enable vertical scrolling
               
            });
            let orders = <?php echo json_encode($orders); ?>;
            let head = Object.keys(orders[0]);
            let row = Object.values(orders[0])
            console.log(row);
            let newData = {
                headings: head,
                // headings: Object.keys(orders),
                // data: [
                //     ["Cell 1", "Cell 2", "Cell 3", "Cell 4"],
                //     ["Cell 5", "Cell 6", "Cell 7", "Cell 8"],
                //     ["Cell 9", "Cell 10", "Cell 11", "Cell 12"],

                // ]
                data: [row]
            };


            dataTable.insert(newData);
        </script>
    @endpush --}}

</x-dashboard-layout>
