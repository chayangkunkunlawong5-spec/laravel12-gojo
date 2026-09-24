<x-weight title="ระบบติดตามน้ำหนัก">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>ระบบติดตามน้ำหนักร่างกาย</h2>

        <a href="{{ route('weight.form') }}" class="btn btn-primary">
            + เพิ่มข้อมูลน้ำหนัก
        </a>

    </div>


    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <!-- ==================== ตารางข้อมูล ==================== -->

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                ประวัติน้ำหนัก
            </h5>

        </div>


        <div class="card-body">

            @if($weights->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover text-center">

                        <thead class="table-light">

                            <tr>

                                <th>ลำดับ</th>

                                <th>วันที่</th>

                                <th>น้ำหนัก (กก.)</th>

                                <th>จัดการ</th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($weights as $weight)

                                <tr>

                                    <td>
                                        {{ $weight->id }}
                                    </td>


                                    <td>
                                        {{ $weight->date }}
                                    </td>


                                    <td>
                                        {{ $weight->weight }}
                                    </td>


                                    <td>

                                        <!-- ปุ่มแก้ไข -->

                                        <a href="{{ route('weight.edit', $weight->id) }}"
                                           class="btn btn-warning btn-sm">

                                            แก้ไข

                                        </a>


                                        <!-- ปุ่มลบ -->

                                        <form action="{{ route('weight.destroy', $weight->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')">

                                                ลบ

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="alert alert-info text-center">

                    ยังไม่มีข้อมูลน้ำหนัก

                </div>

            @endif

        </div>

    </div>



    <!-- ==================== Google Chart ==================== -->

    @if($chartWeights->count() > 0)

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    กราฟน้ำหนัก
                </h5>

            </div>


            <div class="card-body">

                <div id="weightChart"
                     style="width: 100%; height: 500px;">
                </div>

            </div>

        </div>

    @endif



    <!-- Google Charts -->

    <script type="text/javascript"
            src="https://www.gstatic.com/charts/loader.js">
    </script>


    <script>

        google.charts.load('current', {
            packages: ['corechart']
        });


        google.charts.setOnLoadCallback(drawChart);


        function drawChart() {

            const data = google.visualization.arrayToDataTable([

                ['วันที่', 'น้ำหนัก (กก.)'],

                @foreach($chartWeights as $weight)

                    ['{{ $weight->date }}', {{ $weight->weight }}],

                @endforeach

            ]);


            const options = {

                title: 'กราฟติดตามน้ำหนักร่างกาย',

                curveType: 'function',

                legend: {
                    position: 'bottom'
                },

                hAxis: {
                    title: 'วันที่'
                },

                vAxis: {
                    title: 'น้ำหนัก (กก.)'
                }

            };


            const chart = new google.visualization.LineChart(
                document.getElementById('weightChart')
            );


            chart.draw(data, options);

        }

    </script>

</x-weight>