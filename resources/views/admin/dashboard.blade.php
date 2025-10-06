@extends('layouts.admin-layout')
@php($active = 'dashboard')
@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-12 col-lg-10">
            <div class="row g-3">
                <div class="col-12 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">{{ __('Page Views') }}</h6>
                            <div class="d-flex align-items-baseline gap-2">
                                <div class="fw-bold" style="color:#FFD700;font-size:1.6rem">363.95</div>
                                <small class="text-success">▲ 4.2%</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">{{ __('Total Revenue') }}</h6>
                            <div class="d-flex align-items-baseline gap-2">
                                <div class="fw-bold" style="color:#FFD700;font-size:1.6rem">$363.95</div>
                                <small class="text-success">▲ 3.1%</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">{{ __('Bounce Rate') }}</h6>
                            <div class="d-flex align-items-baseline gap-2">
                                <div class="fw-bold" style="color:#FFD700;font-size:1.6rem">38%</div>
                                <small class="text-danger">▼ 0.8%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="mb-3">{{ __('Sales Overview') }}</h6>
                            <canvas id="salesOverview"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="mb-3">{{ __('Total Subscribers') }}</h6>
                            <canvas id="totalSubscribers"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="mb-3">{{ __('Sales Distribution') }}</h6>
                            <canvas id="salesDistribution"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="mb-3">{{ __('List of Integration') }}</h6>
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Stripe</td><td><span class="badge bg-success">{{ __('Active') }}</span></td></tr>
                                        <tr><td>MailChimp</td><td><span class="badge bg-secondary">{{ __('Paused') }}</span></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-lg-none my-3">
                <div class="d-flex align-items-center justify-content-between">
                    <button class="btn btn-link p-0 text-black" data-bs-toggle="offcanvas" data-bs-target="#mobileNav">☰</button>
                    <div class="fw-bold">Product Optimz</div>
                    <button class="btn" style="background:#FFD700;color:#000">{{ __('Add Product') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Product Optimz</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="list-group mb-3">
      <a href="#" class="list-group-item list-group-item-action active" style="background:#FFFACD;color:#000">{{ __('Overview') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Wallet') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Audiences') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Global Report') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Saved Documents') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Email') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Settings') }}</a>
    </div>
    <div class="list-group mb-3">
      <a href="#" class="list-group-item list-group-item-action">{{ __('Help') }}</a>
      <a href="#" class="list-group-item list-group-item-action">{{ __('Feedback') }}</a>
    </div>
    <button class="btn w-100" style="background:#FFD700;color:#000">{{ __('Logout') }} →</button>
  </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const gold = '#FFD700';
const yellowShades = ['#FFE766','#FFDB4D','#FFD233','#FFC61A','#FFBF00'];

new Chart(document.getElementById('salesOverview'), {
  type: 'bar',
  data: {
    labels: ['China','Egypt','KSA','UAE','Turkey','Morocco'],
    datasets: yellowShades.map((c,i)=>({ label: 'Region '+(i+1), data:[5+i,6+i,4+i,7+i,3+i,5+i], backgroundColor: c }))
  },
  options: { plugins:{ legend:{ labels:{ color:'#000', font:{ size:14 } } } }, scales:{ x:{ ticks:{ color:'#333' } }, y:{ ticks:{ color:'#333' } } } }
});

new Chart(document.getElementById('totalSubscribers'), {
  type: 'bar',
  data: { labels:['Sun','Mon','Tue','Wed','Thu','Fri','Sat'], datasets:[{ label:'Subscribers', data:[5,7,9,6,8,10,12], backgroundColor: gold }] },
  options: { plugins:{ legend:{ display:false } }, scales:{ x:{ ticks:{ color:'#333' } }, y:{ ticks:{ color:'#333' } } } }
});

new Chart(document.getElementById('salesDistribution'), {
  type: 'doughnut',
  data: { labels:['Online','Retail','Partners'], datasets:[{ data:[55,30,15], backgroundColor:[gold,'#FFE680','#FFEA99'] }] },
  options: { plugins:{ legend:{ labels:{ color:'#000' } } } }
});
</script>
@endsection



