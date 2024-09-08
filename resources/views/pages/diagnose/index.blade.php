@extends('layouts.master')

@section('content')

    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Diagnose</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <div class="container mt-5">
                <h1 class="mb-4">Select Symptoms</h1>
                <form id="symptomForm">
                    <div class="form-group">
                        <label for="symptoms">Select Symptoms</label>
                        <select id="symptoms" class="form-control" multiple>
                            <!-- Options will be dynamically added by JavaScript -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <hr>
                <h5>Disclaimer</h5>
                <p>The information provided by this expert system is intended for informational purposes only and should not be considered as professional medical advice, diagnosis, or treatment. While the system strives to offer accurate and up-to-date information, it is not a substitute for consulting with a licensed healthcare provider.</p>

                <div id="results" class="mt-4"></div>
            </div>

        </div>



    </section>

@endsection
