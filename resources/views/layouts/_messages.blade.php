@if(session('success'))
	<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
@elseif(session('alert'))	
	<div class="alert alert-danger alert-dismissible fade show">{{ session('alert') }}</div>
@endif