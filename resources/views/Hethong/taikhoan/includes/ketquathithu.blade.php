										<!--begin::Advance Table: Widget 7-->
										<div class="card card-custom gutter-b">
											<!--begin::Header-->
											<div class="card-header border-0 pt-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label font-weight-bolder text-dark">Kết quả thi thử</span>
													{{-- <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span> --}}
												</h3>
												{{-- <div class="card-toolbar">
													<ul class="nav nav-pills nav-pills-sm nav-dark-75">
														<li class="nav-item">
															<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_12_1">Month</a>
														</li>
														<li class="nav-item">
															<a class="nav-link py-2 px-4" data-toggle="tab" href="#kt_tab_pane_12_2">Week</a>
														</li>
														<li class="nav-item">
															<a class="nav-link py-2 px-4 active" data-toggle="tab" href="#kt_tab_pane_12_3">Day</a>
														</li>
													</ul>
												</div> --}}
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body pt-2 pb-0 mt-n3">
												<div class="tab-content mt-5" id="myTabTables12">
													<!--begin::Tap pane-->
													{{-- <div class="tab-pane fade" id="kt_tab_pane_12_1" role="tabpanel" aria-labelledby="kt_tab_pane_12_1"> --}}
														<!--begin::Table-->
                                                        <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>STT</th>
                                                                    <th>Tên đề thi</th>
                                                                    <th>Điểm thi</th>
                                                                    <th>Ngày thi</th>
                                                                    <th>Giờ thi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                                @foreach ($ketquathi as $key => $ketqua)
                                                                    <tr class="text-center">
                                                                        <td style="width: 10%">{{ ++$key }}</td>
                                                                        <td class="text-left" style="width: 30%">{{ $ketqua->tende }}</td>
                                                                        <td style="width: 20%">{{ $ketqua->diemthi }}</td>
                                                                        <td style="width: 20%">{{ getDayVn($ketqua->ngaythi) }}</td>
                                                                        <td style="width: 20%">{{ $ketqua->giothi }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
														<!--end::Table-->
													{{-- </div> --}}
													<!--end::Tap pane-->
												</div>
											</div>
											<!--end::Body-->
										</div>
										<!--end::Advance Table Widget 7-->