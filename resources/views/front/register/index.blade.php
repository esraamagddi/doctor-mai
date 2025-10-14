@extends('layouts.front.app')

@section('title')
{{ __('register') }}
@endsection

@php
$curentLanguage = clanguage();
@endphp
@section('content')
<main>
    <div class="registration-form-wrapper position-relative d-flex justify-content-center align-items-center padding-section">
        <img class="img-fluid position-absolute top-0 start-0" src="{{ asset('assets/front_asset/assets/images/tree-top.svg') }}" alt="">
        <img class="img-fluid position-absolute bottom-0 end-0" src="{{ asset('assets/front_asset/assets/images/tree-bottom.svg') }}" alt="">
        <div class="col-lg-10">
            <section class="registration-form rounded-5">
                <div class="container">
                    <div>
                        <h1 class="main-title">Registration Form to Attend the Forum</h1>
                        <div class="stepper d-flex justify-content-center align-items-center my-5">
                            <div class="step text-center active">
                                <span class="step-circle">
                                    <span class="inner"></span>
                                </span>
                                <div class="step-label">Personal Data</div>
                            </div>
                            <div class="step text-center">
                                <span class="step-circle">
                                    <span class="inner"></span>
                                </span>
                                <div class="step-label">Proof of Identity</div>
                            </div>
                            <div class="step text-center">
                                <span class="step-circle">
                                    <span class="inner"></span>
                                </span>
                                <div class="step-label">General Questions</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Step 1 -->
                            <div class="form-step active">
                                <div class="row g-4 pb-5 pt-3 border-bottom border-top border-opacity-50 border-secondary">
                                    <div class="col-lg-4">
                                        <label for="fullName">Full Name</label>
                                        <div class="position-relative">
                                            <i class="bi bi-person-fill position-absolute top-50 start-0 translate-middle-y ms-2 fs-4 text-black"></i>
                                            <input class="form-control ps-5" type="text" id="fullName" name="fullName" placeholder="Full Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="email">Email</label>
                                        <div class="position-relative">
                                            <i class="bi bi-envelope-fill position-absolute top-50 start-0 translate-middle-y ms-2 fs-4 text-black"></i>
                                            <input class="form-control ps-5" type="email" id="email" name="email" placeholder="ex: egypt@gmail.com" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="phoneNumber">Phone Number</label>
                                        <div class="position-relative">
                                            <i class="bi bi-telephone-fill position-absolute top-50 start-0 translate-middle-y ms-2 fs-4 text-black"></i>
                                            <input class="form-control ps-5" type="text" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 justify-content-lg-between justify-content-center py-5 border-bottom border-opacity-50 border-secondary">
                                    <div class="col-lg-2">
                                        <label for="gender">Gender</label>
                                        <select id="gender" name="gender" class="form-select" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="nationality">Nationality</label>
                                        <select id="nationality" name="nationality" class="form-select" required>
                                            <option value="American">American</option>
                                            <option value="Egyptian">Egyptian</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="countryOfResidence">Country of Residence</label>
                                        <select id="countryOfResidence" name="countryOfResidence" class="form-select" required>
                                            <option value="">Where do you reside ?</option>
                                            <option value="USA">USA</option>
                                            <option value="Egypt">Egypt</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="age">Age</label>
                                        <select id="age" name="age" class="form-select" required>
                                            <option value="">How old are you?</option>
                                            <option value="18-20">18-20</option>
                                            <option value="20-35">20-35</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="preferredLanguage">Preferred Language</label>
                                        <select id="preferredLanguage" name="preferredLanguage" class="form-select" required>
                                            <option value="">language Speak?</option>
                                            <option value="ar">Arabic</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 justify-content-lg-between justify-content-center py-5">
                                    <div class="col-lg-3">
                                        <label for="educationalQualification">Educational Qualification</label>
                                        <input class="form-control" type="text" id="educationalQualification" name="educationalQualification" placeholder=" Educational Qualification" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="currentJob">Current Job</label>
                                        <input class="form-control" type="text" id="currentJob" name="currentJob" placeholder="Current Job" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="workplace">Workplace</label>
                                        <input class="form-control" type="text" id="workplace" name="workplace" placeholder="Workplace" required>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="typeOfWork">Type of Work</label>
                                        <select id="typeOfWork" name="typeOfWork" class="form-select" required>
                                            <option value="Government Entity">Government Entity</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="next-btn btn main-btn mx-auto px-5">NEXT</button>
                            </div>
                            <!-- Step 2 -->
                            <div class="form-step">
                                <div class="row g-4 pb-5 pt-3 border-bottom border-top border-opacity-50 border-secondary">
                                    <div class="col-lg-4">
                                        <label for="IDnumber">ID Card Number / Passport Number</label>
                                        <div class="position-relative">
                                            <i class="bi bi-person-vcard position-absolute top-50 start-0 translate-middle-y ms-2 fs-4 text-black"></i>
                                            <input class="form-control ps-5" type="text" id="IDnumber" name="IDnumber" placeholder="ID Card Number / Passport Number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="IDissueDate">ID Card / Passport Issue Date</label>
                                        <div class="position-relative">
                                            <i id="IDissueDateBtn" class="bi bi-calendar3 position-absolute top-50 start-0 translate-middle-y ms-2 fs-4 text-black"></i>
                                            <input class="form-control ps-5" type="date" id="IDissueDate" name="IDissueDate" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="IDExpiryDate">ID Card / Passport Expiry Date</label>
                                        <div class="position-relative">
                                            <i id="IDExpiryDateBtn" class="bi bi-calendar3 position-absolute top-50 start-0 translate-middle-y ms-2 fs-4 text-black"></i>
                                            <input class="form-control ps-5" type="date" id="IDExpiryDate" name="IDExpiryDate" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center py-5">
                                    <div class="col-lg-5">
                                        <label for="IDphoto">Photo of ID Card / Passport</label>
                                        <div class="upload-box">
                                            <label for="IDphoto" class="upload-label">
                                                Upload the image
                                                <i class="bi bi-upload upload-icon"></i>
                                            </label>
                                            <div class="upload-desc">(PNG / JPG / PDF)</div>
                                            <input type="file" id="IDphoto" name="IDphoto" accept=".png,.jpg,.jpeg,.pdf" required>
                                            <div class="fileName" id="IDphotoFileName"></div>
                                            <img class="filePreview" id="IDphotoFilePreview" src="" alt="" style="display:none;">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-4">
                                    <button type="button" class="prev-btn btn btn-outline-secondary px-5 py-2">Previous</button>
                                    <button type="button" class="next-btn btn main-btn px-5">NEXT</button>
                                </div>
                            </div>
                            <!-- Step 3 -->
                            <div class="form-step">
                                <div class="py-5 border-bottom border-top border-opacity-50 border-secondary">
                                    <div class="d-flex justify-content-between align-items-center gap-4 mb-4">
                                        <p>Any special requirements for your forum attendance?</p>
                                        <div class="toggle-btn-group d-flex flex-wrap gap-3">
                                            <div>
                                                <input type="radio" class="btn-check" name="q1" id="q1Yes" autocomplete="off" value="1">
                                                <label class="btn btn-outline-success mb-0" for="q1Yes">YES</label>
                                            </div>
                                            <div>
                                                <input type="radio" class="btn-check" name="q1" id="q1No" autocomplete="off" value="0">
                                                <label class="btn btn-outline-success mb-0" for="q1No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea
                                        id="q1Text" name="q1Text" class="form-control questions-textarea" placeholder="Please explain"></textarea>
                                </div>
                                <div class="py-5 border-bottom border-opacity-50 border-secondary">
                                    <div class="d-flex justify-content-between align-items-center gap-4 mb-4">
                                        <p>Have you participated in previous conferences or workshops on climate?</p>
                                        <div class="toggle-btn-group d-flex flex-wrap gap-3">
                                            <div>
                                                <input type="radio" class="btn-check" name="q2" id="q2Yes" autocomplete="off" value="1">
                                                <label class="btn btn-outline-success mb-0" for="q2Yes">YES</label>
                                            </div>
                                            <div>
                                                <input type="radio" class="btn-check" name="q2" id="q2No" autocomplete="off" value="0">
                                                <label class="btn btn-outline-success mb-0" for="q2No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea
                                        id="q2Text" name="q2Text" class="form-control questions-textarea" placeholder="Please explain"></textarea>
                                </div>
                                <div class="py-5 border-bottom border-opacity-50 border-secondary">
                                    <div class="d-flex justify-content-between align-items-center gap-4 mb-4">
                                        <p>Do you have any suggestions or topics you wish to be covered during the conference?</p>
                                        <div class="toggle-btn-group d-flex flex-wrap gap-3">
                                            <div>
                                                <input type="radio" class="btn-check" name="q3" id="q3Yes" autocomplete="off" value="1">
                                                <label class="btn btn-outline-success mb-0" for="q3Yes">YES</label>
                                            </div>
                                            <div>
                                                <input type="radio" class="btn-check" name="q3" id="q3No" autocomplete="off" value="0">
                                                <label class="btn btn-outline-success mb-0" for="q3No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea
                                        id="q3Text" name="q3Text" class="form-control questions-textarea" placeholder="Please explain"></textarea>
                                </div>
                                <div class="py-5 border-bottom border-opacity-50 border-secondary">
                                    <div class="d-flex justify-content-between align-items-center gap-4 mb-4">
                                        <p>Are you a member of any environmental organization or volunteer initiative?</p>
                                        <div class="toggle-btn-group d-flex flex-wrap gap-3">
                                            <div>
                                                <input type="radio" class="btn-check" name="q4" id="q4Yes" autocomplete="off" value="1">
                                                <label class="btn btn-outline-success mb-0" for="q4Yes">YES</label>
                                            </div>
                                            <div>
                                                <input type="radio" class="btn-check" name="q4" id="q4No" autocomplete="off" value="0">
                                                <label class="btn btn-outline-success mb-0" for="q4No">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea
                                        id="q4Text" name="q4Text" class="form-control questions-textarea" placeholder="Please explain"></textarea>
                                </div>
                                <div class="py-5">
                                    <div class="d-flex justify-content-between align-items-center gap-4 flex-wrap mb-4">
                                        <p>Preferred participation type?</p>
                                        <div class="d-flex gap-3 flex-wrap">
                                            <div>
                                                <div class="fileName" id="participationTypeFileName"></div>
                                            </div>
                                            <div class="d-flex gap-3">
                                                <select id="participationType" name="participationType" class="form-select" required>
                                                    <option value="Attendance Only">Attendance Only</option>
                                                </select>
                                                <div class="upload-box small-box">
                                                    <label for="participationTypeUpload" class="upload-label">
                                                        Upload File
                                                        <i class="bi bi-upload upload-icon"></i>
                                                    </label>
                                                    <input type="file" id="participationTypeUpload" name="participationTypeUpload" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center gap-4">
                                    <button type="button" class="prev-btn btn btn-outline-secondary px-5 py-2">Previous</button>
                                    <button type="submit" class="btn main-btn px-5">Submit Form</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>


@endsection