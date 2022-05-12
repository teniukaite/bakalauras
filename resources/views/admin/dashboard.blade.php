@extends('theme')

@section('content')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <div class="row ">
                <div class="col-xl-12 ">
                    <div class="white_card card_height_100 mb_30 user_crm_wrapper">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="single_crm">
                                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="fa-solid fa-users white"></i>
                                        </div>
                                        <p class="text">Registruoti naudotojai</p>
                                    </div>
                                    <div class="crm_body">
                                        <h4>{{$userCount}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single_crm ">
                                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="fa-solid fa-user-tie white"></i>
                                        </div>
                                        <p class="text">Laisvai samdomi darbuotojai</p>
                                    </div>
                                    <div class="crm_body">
                                        <h4>{{$freelancerCount}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single_crm">
                                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="fa-solid fa-user white"></i>
                                        </div>
                                        <p class="text">Naudotojai</p>
                                    </div>
                                    <div class="crm_body">
                                        <h4>{{$usersCount}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single_crm">
                                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="fa-solid fa-user-gear white"></i>
                                        </div>
                                        <p class="text">Moderatoriai</p>
                                    </div>
                                    <div class="crm_body">
                                        <h4>{{$moderatorCount}}</h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single_crm">
                                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="fa-solid fa-toolbox white"></i>
                                        </div>
                                        <p class="text">Administratoriai</p>
                                    </div>
                                    <div class="crm_body">
                                        <h4>{{$adminCount}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single_crm">
                                    <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="fa-solid fa-user-plus white"></i>
                                        </div>
                                        <p class="text">Šiandien prisiregistravę naudotojai</p>
                                    </div>
                                    <div class="crm_body">
                                        <h4>{{$newUsers}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div id="usersContainer" style="height: 300px; width: 100%;margin-bottom: 70px;"></div>
                            <div id="categoriesContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .text {
            color: #FFFFFF;
            font-size: large;
        }

        .white {
            color: #FFFFFF;
        }
    </style>
@endsection

@section('js')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

        async function showUsers() {
            let data = {};
            await $.ajax({
                url: '/api/users',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    data = response.usersCount.map((element) => {
                        return {
                            label: element.name,
                            y: element.users_count
                        }
                    });
                }
            })

            const chart = new CanvasJS.Chart("usersContainer", {
                title:{
                    text: "Naudotojų pasiskirstymas pagal miestus"
                },
                data: [
                    {
                        // Change type to "doughnut", "line", "splineArea", etc.
                        type: "column",
                        dataPoints: data,
                    }
                ]
            });
            chart.render();
        }

        async function showCategories() {
            let data = {};
            await $.ajax({
                url: '/api/categories',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    data = response.ordersCount.map((element) => {
                        return {
                            indexLabel: element.name + " (" + element.orders_count + ")",
                            y: element.orders_count
                        }
                    });
                }
            })

            console.log(data);

            const chart = new CanvasJS.Chart("categoriesContainer", {
                title:{
                    text: "Užsakymų pasiskirstymas pagal kategorijas"
                },
                data: [
                    {
                        type: "pie",
                        dataPoints: data,
                    }
                ]
            });

            chart.render();
        }

        window.onload = async function () {
            await showUsers();
            await showCategories();
        }

    </script>
@endsection
