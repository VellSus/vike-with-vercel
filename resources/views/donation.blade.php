<link rel = "stylesheet" href="./css/bootstrap.css">
<link rel = "stylesheet" href="./donation.css">
<script src="./js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- just in case need to change font-->
 @include('layout.navbar')
<div class="background">
    <div class="container text-center py-3">
        <!-- name -->
        <div class="mb-4">
        <span class="S">S</span>
        <span class="A1">A</span>
        <span class="V">V</span>
        <span class="E1">E</span>
        <span class="E2">E</span>
        <span class="A2">A</span>
        <span class="R">R</span>
        <span class="T">T</span>
        <span class="H">H</span>
            <div class="earth">
                <h1 class="amount">{{ $totalDonated }}</h1>
            </div>
        </div>
    </div>
</div>

        <!-- Form Section -->
    <form id="donationForm" action="{{ route('donation.store') }}" method="POST">
        @csrf
        <input type="hidden" name="step" value="{{ session('step', '1') }}">
        
        @if (session('step', '1') == '1')
            <div class="form-section mx-auto p-4 mb-4 border rounded shadow p-3 mb-5" style="width: 500px; background-image:linear-gradient(#44FC3E, #FFFFFF);" id="donasi">
                <h3 class="text-center fw-bold" style="color: #19406C; font-size:35;">SELAMATKAN BUMI!</h3>
                <p class="text-center fw-bold" style="color: #19406C;">Rp.10,000 PER TANAMAN</p>
                <div class="mb-3">
                    <input type="number" id="plants" name="planted" class="form-control rounded border border-4 border-dark @error('planted') is-invalid @enderror" value="{{ old('planted') }}" placeholder="Jumlah tanaman">
                    @error('planted')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <p class="fw-bold text-center">Total: Rp.<span id='total'>0</span></p>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="text" id="email" name="email" class="form-control rounded border border-4 border-dark @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email donor">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama:</label>
                    <input type="text" id="name" name="name" class="form-control rounded border border-4 border-dark @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama yang ingin di display">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan:</label>
                    <textarea id="message" name="message" class="form-control rounded border border-4 border-dark @error('message') is-invalid @enderror" placeholder="Pesan yang ingin di display" style="overflow: hidden; resize: none; height: 40px;">{{ old('message') }}</textarea>
                    @error('message')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold" style="border-radius:30px">Next</button>
            </div>
                @elseif (session('step') == '2')
            <div class="form-section mx-auto p-4 mb-4 border border-4 border-dark rounded show collapse" style="max-width: 400px; background-color: #b0e8b5;" id="pembayaran">
                <h2 class="text-center">Info Pembayaran</h2>
                <hr>
                <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn p-0 border-4 btn-primary me-3"style="width: 105px; height: 68px;" disabled><img src="debit.png" class="img-fluid"></button>
                <button type="button" class="btn p-0 border-4 btn-primary me-3"style="width: 105px; height: 68px;" data-bs-toggle="collapse" data-bs-target="#pembayaran, #pembayaran2"><img src="qris.png" class="img-fluid"></button>
                <button type="button" class="btn p-0 border-4 btn-primary"style="width: 105px; height: 68px;" data-bs-toggle="collapse" data-bs-target="#pembayaran, #pembayaran3"><img src="gopay.png" class="img-fluid"></button>
                </div>
                <h2 class="text-center">Total payment: RP.<span id="total2">{{ number_format(session('donation.planted') * 10000, 0, ',', '.') }}</span></h2>
                <input type="number" id="cardNumber" class="form-control text-center rounded border border-4 border-dark" placeholder="CARD NUMBER" maxlength="19">
                <input type="text" id="cardName" class="form-control text-center rounded border border-4 border-dark mb-2" placeholder="CARDHOLDER NAME">
                <div class="row">
                    <div class="col-4">
                        <input type="number" id="cardMM" class="form-control text-center rounded border border-4 border-dark" placeholder="MM" maxlength="2">
                    </div>
                    <div class="col-4">
                        <input type="number" id="cardYY" class="form-control text-center rounded border border-4 border-dark" placeholder="YY" maxlength="4">
                    </div>
                    <div class="col-4">
                        <input type="number" id="cardCVV" class="form-control text-center rounded border border-4 border-dark" placeholder="CVV" maxlength="4">
                    </div>
                </div>
                <div class="expiry-cvv mt-3 row">
                    <div class="col-4" style="width:180px;">
                        <button type="submit" name="action" value="confirm" class="btn btn-primary w-100 fw-bold mb-2" style="border-radius:30px">CONFIRM</button>
                    </div>
                    <div class="col-4" style="width:180px;">
                        <button type="submit" name="step" value="1" class="btn btn-primary w-100 fw-bold" style="border-radius:30px">CANCEL</button>
                    </div>
                </div>
            </div>

            <div class="form-section mx-auto p-4 mb-4 border border-4 border-dark rounded collapse" style="max-width: 400px; background-color: #b0e8b5;" id="pembayaran2">
                <h2 class="text-center">Info Pembayaran</h2>
                <hr>
                <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn p-0 border-4 btn-primary me-3"style="width: 105px; height: 68px;"data-bs-toggle="collapse" data-bs-target="#pembayaran, #pembayaran2"><img src="debit.png" class="img-fluid"></button>
                <button type="button" class="btn p-0 border-4 btn-primary me-3"style="width: 105px; height: 68px;"disabled><img src="qris.png" class="img-fluid"></button>
                <button type="button" class="btn p-0 border-4 btn-primary"style="width: 105px; height: 68px;" data-bs-toggle="collapse" data-bs-target="#pembayaran2, #pembayaran3"><img src="gopay.png" class="img-fluid"></button>
                </div>
                <h2 class="text-center">Total payment: RP.<span id="total2">{{ number_format(session('donation.planted') * 10000, 0, ',', '.') }}</span></h2>
                <img src="qrcode.png" style="object-fit:contain; max-width:100%;">
                    <div class="mt-3  d-flex justify-content-center">
                        <button type="submit" name="step" value="1" class="btn btn-primary w-100 fw-bold" style="border-radius:30px; width:180px;">CANCEL</button>
                    </div>
            </div>

            <div class="form-section mx-auto p-4 mb-4 border border-4 border-dark rounded collapse" style="max-width: 400px; background-color: #b0e8b5;" id="pembayaran3">
                <h2 class="text-center">Info Pembayaran</h2>
                <hr>
                <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn p-0 border-4 btn-primary me-3"style="width: 105px; height: 68px;"data-bs-toggle="collapse" data-bs-target="#pembayaran, #pembayaran3"><img src="debit.png" class="img-fluid"></button>
                <button type="button" class="btn p-0 border-4 btn-primary me-3"style="width: 105px; height: 68px;"data-bs-toggle="collapse" data-bs-target="#pembayaran2, #pembayaran3"><img src="qris.png" class="img-fluid"></button>
                <button type="button" class="btn p-0 border-4 btn-primary"style="width: 105px; height: 68px;" disabled><img src="gopay.png" class="img-fluid"></button>
                </div>
                <h2 class="text-center">Total payment: RP.<span id="total2">{{ number_format(session('donation.planted') * 10000, 0, ',', '.') }}</span></h2>
                <input type="number" id="PhoneNumber" class="form-control text-center rounded border border-4 border-dark" placeholder="Nomor hp" maxlength="14">
                <div class="expiry-cvv mt-3 row">
                    <div class="col-4" style="width:180px;">
                        <button type="submit" name="action" value="confirm" class="btn btn-primary w-100 fw-bold mb-2" style="border-radius:30px">CONFIRM</button>
                    </div>
                    <div class="col-4" style="width:180px;">
                        <button type="submit" name="step" value="1" class="btn btn-primary w-100 fw-bold" style="border-radius:30px">CANCEL</button>
                    </div>
                </div>
            </div>
        @endif
    </form>
        <!-- Leaderboard Section -->
        <div id=terbanyak class="collapse show" id="terbanyak">
            <h3 class="text-center fw-bold" style="color: #19406C; font-size:100;">Leaderboard</h3>
            <div class="d-flex justify-content-center my-3">
                <button class="btn border border-4 border-dark rounded mx-2"style="width:200px;color: #19406C;background-color: #96CC94"id="terbarubutton" data-bs-toggle="collapse" data-bs-target="#terbanyak, #terbaru">Terbaru</button>
                <button class="btn border border-4 border-dark rounded mx-2"style="width:200px;color: #19406C;background-color: #b0e8b5">Tanaman Terbanyak</button>
            </div>
                 @php
                    if ($highestPlantedDonation->planted < 10) {
                        $image = 'seed.png';
                    }else if($highestPlantedDonation->planted<100){
                        $image = 'plantgrow.png';
                    }
                    else if($highestPlantedDonation->planted<1000){
                        $image = 'tree.png';
                    }
                    else{
                        $image = 'earth2.png';
                    }
                @endphp
            <img src="{{ asset($image) }}"class="rounded-circle border border-dark text-centered rounded mx-auto d-block" style="max-width: 100px;background-image: linear-gradient(#44FC3E, #FFFFFF);">
            <div class="leaderboard-card mx-auto p-3 mb-3 text-center" style="max-width: 700px;background-image: linear-gradient(#19406C, #327CD2);margin-top:-20px;z-index:2;">
                <h4 class="fw-bold" style="font-size:60px;">{{ $highestPlantedDonation->name }}</h4>
                <p class="fs-2 border rounded-pill" style="background-color: #96CC94">{{ number_format($highestPlantedDonation->planted) }} tanaman</p>
                <span style="font-size:30px;">{{ $highestPlantedDonation->message }}</span>
                <p class="donation-date">ditanam pada {{ \Carbon\Carbon::parse($highestPlantedDonation->created_at)->format('d/m/Y') }}</p>
            </div>

    @foreach($nextHighestPlantedDonations as $donation)
    <div style="margin-bottom:20px;">
        <div class="d-flex flex-column align-items-start" style="position: relative; max-width: 700px; margin: auto;">
                @php
                    if ($donation->planted < 10) {
                        $image = 'seed.png';
                    }else if($donation->planted<100){
                        $image = 'plantgrow.png';
                    }
                    else if($donation->planted<1000){
                        $image = 'tree.png';
                    }
                    else{
                        $image = 'earth2.png';
                    }
                @endphp
            <div class="rounded-circle border border-dark" style="width: 60px; height: 60px; position: absolute; background-image: linear-gradient(#44FC3E, #FFFFFF); top: 6px; left: -30px;">
                <img src="{{ asset($image) }}" class="rounded-circle border border-white" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            </div>
            <div class="leaderboard-card mx-auto p-1" style="width: 700px; height: 70px; background-image: linear-gradient(to right, #19406C, #327CD2); display: flex; justify-content: space-between; align-items: center;">
                <div class="flex-grow-1 d-flex flex-column" style="margin-left: 25px;">
                    <h4 class="mb-0 fw-bold" style="font-size:30px;">{{ $donation->name }}</h4>
                    <span style="font-size: 18px; line-height: 1;">{{ $donation->message }}</span>
                </div>
                <div class="text-end flex-shrink-1">
                    <h4 class="mb-0 border rounded-pill text-center" style="background-color: #96CC94; font-size:30px;">{{ number_format($donation->planted) }} tanaman</h4>
                    <p class="donation-date mb-0" style="font-size: 15px; line-height: 1;">ditanam pada {{ \Carbon\Carbon::parse($donation->created_at)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
    
        <div id="terbaru" class="collapse" id="terbaru">
    <h3 class="text-center fw-bold" style="color: #19406C; font-size:100;">Leaderboard</h3>
    <div class="d-flex justify-content-center my-3">
        <button class="btn border border-4 border-dark rounded mx-2" style="width:200px;color: #19406C;background-color: #b0e8b5">Terbaru</button>
        <button class="btn border border-4 border-dark rounded mx-2" style="width:200px;color: #19406C;background-color: #96CC94" id="terbanyakbutton" data-bs-toggle="collapse" data-bs-target="#terbaru, #terbanyak">Tanaman Terbanyak</button>
    </div>
    @foreach($latestDonations as $donation)
    <div style="margin-bottom:20px;">
        <div class="d-flex align-items-start" style="position: relative; max-width: 700px; margin: auto;">
            <div class="rounded-circle border border-dark" style="width: 60px; height: 60px; position: absolute; background-image: linear-gradient(#44FC3E, #FFFFFF); top: 6px; left: -30px;">
                 @php
                    if ($donation->planted < 10) {
                        $image = 'seed.png';
                    }else if($donation->planted<100){
                        $image = 'plantgrow.png';
                    }
                    else if($donation->planted<1000){
                        $image = 'tree.png';
                    }
                    else{
                        $image = 'earth2.png';
                    }
                @endphp
                <img src="{{ asset($image) }}" class="rounded-circle border border-white" style="width: 50px; height: 50px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            </div>
            <div class="leaderboard-card mx-auto p-1" style="width: 700px; height: 70px; background-image: linear-gradient(to right, #19406C, #327CD2); display: flex; justify-content: space-between; align-items: center;">
                <div class="flex-grow-1 d-flex flex-column" style="margin-left: 25px;">
                    <h4 class="mb-0 fw-bold" style="font-size:30px;">{{ $donation->name }}</h4>
                    <span style="font-size: 18px; line-height: 1;">{{ $donation->message }}</span>
                </div>
                <div class="text-end flex-shrink-1">
                    <h4 class="mb-0 border rounded-pill text-center" style="background-color: #96CC94; font-size:30px;">{{ number_format($donation->planted) }} tanaman</h4>
                    <p class="donation-date mb-0" style="font-size: 15px; line-height: 1;">ditanam pada {{ \Carbon\Carbon::parse($donation->created_at)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@include('layout.footer')
<script>
    $(document).ready(function() {
        var total=0;
        $('#plants').on('input', function() {
            var plantCount = parseInt($(this).val()) || 0;
            total = plantCount * 10000;
            $('#total').text(total.toLocaleString('en-US'));
            $('#total2').text(total.toLocaleString('en-US'));
        });
    });
</script>

