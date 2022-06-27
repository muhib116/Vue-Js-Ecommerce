@foreach($sections as $section)
@if(View::exists('frontend.homepage.'.$section->section_type))
	@php try{ @endphp
	@include('frontend.homepage.'.$section->section_type)
	@php }catch(\Exception $e){
		echo '';
	} 
	@endphp
@endif
@endforeach 