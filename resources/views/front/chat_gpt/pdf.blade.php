
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="https://reports.divinestore.net/public/assets/img/favicon.png') !!}" type="image/x-icon">
	<link href="https://reports.divinestore.net/public/assets/css/style.css" rel="stylesheet">
	<link href="https://reports.divinestore.net/public/assets/css/pdfpagewestern_style.css" rel="stylesheet">
	<title>Report View</title>

	<style>
		@page :first {background-image: url({{ asset('pdf/images/number-7.png') }}); background-image-resize: 4; background-repeat: no-repeat; width: 100%;height: 100%; footer: html_myFooter;}
		@page { background-image: url({!! asset('pdf/images/image-2.jpg') !!});background-size: cover; width: 100%;height: 100%; footer: html_myFooter;}
	</style>
</head>

<body style=" ">
	<style>
		<?php require_once base_path() . '/public/pdf_css.php'; ?>

        .topic_page { height: 100%; padding: 0; box-sizing: border-box;
        }
		.main_box.pdf_box{ padding: 0 !important}
		.absolute_div{ position: unset  !important;}

	</style>

	<htmlpagefooter name="myFooter">
		<div style="font-size: 10pt; padding-top: 5px; border-top: 1px solid #ccc; margin: 0 20px">
			<table width="100%">
				<tr>
					<td width="33%">{PAGENO}</td>
					<td width="66%" align="right">Romance Numerology</td>
				</tr>
			</table>
		</div>
	</htmlpagefooter>

	@php
	$showURL = URL::to('/')
	@endphp

		<div class="topic_page" style="">
			<div class="main_box pdf_box" style="display: block;width: 100%;">
				<div class="top_box" style="display: block;width: 100%; padding:20px;">
					{{-- <img style="margin-left: 40px;width: 150px;float: left;" src="{{ asset('assets/front/images/logo-white.png') }}" alt=""> --}}
					<table  width="100%">
						<tr>
							<td style="width: 50%; color:#fff; font-size:16px;" >Romance Numerology</td>
							<td style="width: 50%; text-align:right; color:#fff; font-size:16px;" >2025</td>
						</tr>
					</table>
				</div>
				<div class="title_box">
					<p>Nitish Guglani</p>
					<h1><b>Welcome to<br> Your Personal<br> Soulmate Journey</b></h1>
				</div>
			</div>
		</div>


	<?php $i = 1; ?>
    @foreach($solumatdata as $data)

    @php
        // Split and clean up paragraphs
        $paragraphs = array_filter(array_map('trim', explode("\n", $data->description)));
        $chunks = array_chunk($paragraphs, 5);


    @endphp

		@foreach ($chunks as $index => $chunk)
			<div class="topic_page">
				<div class="main_box pdf_box" style="padding: 5mm;">
					<div class="absolute_div">
						{{-- Only show title on the first page --}}
						@if ($index === 0)
							<div class="title_big">
								<h1>{{ $data->chapter }}</h1>
							</div>
						@endif

						<div class="chapter_main plr_40">
							@php $paraIndex = 0; @endphp
							@foreach ($chunk as  $para)
								@php $paraIndex++; @endphp
								<p style="margin-bottom: 5mm; font-size:18px">{!! nl2br(e($para)) !!}</p>
								@if ($paraIndex === 3)
									<img src="{{ asset('pdf/images/landscape/' . $i . '.png') }}" alt="" style="display: block; height: 300px; width: auto; max-width: 100%; margin: 20px auto;">
									@php
										$i++;
										if($i > 17){
											$i = 1;
										}
									@endphp
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</div>

			@if ($index < count($chunks) - 1)
				<pagebreak />
			@endif
		@endforeach



	<!-- Dynamic Code End -->
     @endforeach

	<!-- <div class="topic_page" style="background-image: url({!! asset('pdf/images/back-3.jpg') !!});background-size: cover;width: 100%;height: 100%;">
		<div class="main_box pdf_box">
			<div class="absolute_div conclusion_box">
				<div class="p_8">
					<div class="conclution_title">
						<h1><b>Conclusion</b></h1>
					</div>
					<div class="reflecting_box text_box">
						<h2><b>Reflecting on Your Soulmate Journey</b></h2>
						<div class="txt_box" style="position: relative;margin-top: 32px;">
							<h5><img style="margin-bottom: -5px;" class="title_before" src="{!! asset('pdf/images/white-before.png') !!}" alt="">Summary of the insights and guidance provided in the eBook</h5>
							<h5 style="margin-top: 15px;"><img style="margin-bottom: -5px;" class="title_before" src="{!! asset('pdf/images/white-before.png') !!}" alt="">Encouragement to embrace the exciting and adventurous love awaiting you.</h5>
						</div>
					</div>
					<div class="reflecting_box text_box">
						<h2><b>Next Steps in Your Love Story</b></h2>
						<div class="txt_box" style="position: relative;margin-top: 32px;">
							<h5><img style="margin-bottom: -5px;" class="title_before" src="{!! asset('pdf/images/white-before.png') !!}" alt="">Practical steps for continuing to nurture and grow your relationship.</h5>
							<h5 style="margin-top: 15px;"><img style="margin-bottom: -5px;" class="title_before" src="{!! asset('pdf/images/white-before.png') !!}" alt="">Suggestions for ongoing personal and relational development.</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->

</body>

</html>
