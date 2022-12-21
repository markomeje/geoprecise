<div class="dashboard">
  @include('admin.includes.header')
      <div class="min-height-300 bg-primary position-absolute w-100"></div>
      @include('admin.includes.aside')
      <main class="main-content position-relative border-radius-lg">
      <!-- Navbar -->
        @include('admin.includes.navbar')
      <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="p-4 bg-white">
                <div class="alert alert-dark d-flex mb-4 border-0 align-items-center">
                    <a class="text-white me-2" href="javascript:;">
                        {{ \App\Models\Plan::count() }} Plans</a>
                    <a class="m-0 text-white" href="javascript:;" data-bs-toggle="modal" data-bs-target="#add-plan">Add Plan</a>
                </div>
                @include('admin.plans.partials.add')
                @if(empty($plans->count()))
                <div class="alert alert-info mt-4 border-0 text-white">No plans available</div>
                @else
                    <div class="p-4 bg-dark">
                        <form method="get" action="" class="m-0">
                            <input class="form-control form-control-lg m-0" type="search" name="query" placeholder="Search plans" value="{{ request()->get('query') }}">
                        </form>
                    </div>
                <div class="row mt-4">
                    @foreach($plans as $plan)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        @include('admin.plans.partials.card')
                    </div>
                    @include('admin.plans.partials.edit')
                    @endforeach
                    {{ $plans->links('vendor.pagination.default') }}
                </div>
                @endif
                </div>
        </div>
    </main>
    @include('admin.includes.rightbar')
  @include('admin.includes.footer')
</div>