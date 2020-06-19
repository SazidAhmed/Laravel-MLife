@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <div class="container">
                                <mywish id="mywish"></mywish>
                            </div>
                        </div>
                        <div class="card-footer text-white">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p>Developed by :</p>
                                    <p>Sazid Ahmed. <br>
                                    Based on Laravel, Vue & Bootstrap. <br>
                                    copyright@sazidahmed
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p>Visit On:</p>
                                    <p><a href="https://www.facebook.com/sazidahmed.official" class="text-white">Facebook</a> <br>
                                    <a href="https://www.twitter.com/sazid_bd?s=09" class="text-white">Twetter</a> <br>
                                    <a href="https://www.linkedin.com/in/sazidahmed-codeman" class="text-white">Linkedin</a>
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <p>Contact On: </p>
                                    <p>Email : sazidahmed.official@gmail.com <br>
                                    Mobile: +8801680800810 <br>
                                    Uttara, Dhaka, Bangladesh</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
