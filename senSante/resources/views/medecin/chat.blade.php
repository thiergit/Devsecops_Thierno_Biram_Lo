@push('styles')
<link rel="stylesheet" href="{{url('css/chat.css')}}">
@endpush
@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
        const MedecinId = {{ Auth::user()->medecin->id }};
    </script>
	<script src="{{url('js/chatM.js')}}"></script>

@endpush
@extends('../medecin.app')
    
@section('content')
<main class="content">
    <div class="container p-0">

		<h1 class="h3 mb-3">Messages</h1>

		<div class="card">
			<div class="row g-0">
				<div class="col-12 col-lg-5 col-xl-3 border-right">
					@foreach ($patients as $patient)
						<a href="#" class="list-group-item list-group-item-action border-0 other-conv"  data-nom="{{$patient->user->nom}}" data-prenom="{{$patient->user->prenom}}" data-id ="{{$patient->id}}">
							<div class="badge bg-success float-right">5</div>
							<div class="d-flex align-items-start">
								<div class="flex-grow-1 ml-3">
									{{$patient->user->nom}} {{$patient->user->prenom}}
									<div class="small"><span class="fas fa-circle chat-online"></span> Patient</div>
								</div>
							</div>
						</a>
					@endforeach
					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
				<div class="col-12 col-lg-7 col-xl-9">
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong id="nom"></strong>
							</div>
							<div>
								<button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>
								<button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4" id="chat-messages">
							

							



						</div>
					</div>

					<div class="flex-grow-0 py-3 px-4 border-top">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Type your message" id="message">
							<button class="btn btn-primary" id="submitbtn">Send</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</main>

@endsection