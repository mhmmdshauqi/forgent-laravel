@extends('layouts.dashboard')

@section('title')
    Store Dashboard
@endsection

@section('content')
<!--Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
              </div>
              <div class="dashboard-content">
                <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <h5 class="mb-3">Transaction History</h5>
                    @foreach ($buyTransactions as $transaction)
                    <a href="{{ route('dashboard-transactions-details', $transaction->id) }}" class="card card-list d-block">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img 
                            src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                            class="w-75" />
                          </div>
                          <div class="col-md-4">{{ $transaction->product->name }}</div>
                          <div class="col-md-3">{{ $transaction->transaction->transaction_status }}</div>
                          <div class="col-md-3">{{ $transaction->created_at }}</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img src="/images/dashboard-arrow-right.svg" alt="" />
                          </div>
                        </div>
                      </div>
                    </a>
                    @endforeach 
                  </div>
                </div>
              </div>
            </div>
          </div>
    
@endsection