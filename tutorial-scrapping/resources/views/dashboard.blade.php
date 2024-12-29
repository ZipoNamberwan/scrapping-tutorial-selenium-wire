<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pegawai Perusahaan Mbah Dulah Amir
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">

                <table class="table" id="myTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <script>
        var table = $('#myTable').DataTable({
            "order": [],
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": '/pegawai',
                "type": 'GET',
            },
            "columns": [{
                    "responsivePriority": 1,
                    "data": "name",
                },
                {
                    "responsivePriority": 1,
                    "data": "email",
                },
            ],
            "language": {
                'paginate': {
                    'previous': '<i class="fas fa-angle-left"></i>',
                    'next': '<i class="fas fa-angle-right"></i>'
                }
            }
        });
    </script>

</x-app-layout>