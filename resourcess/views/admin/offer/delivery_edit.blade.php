<input type="hidden" value="{{$delivery->id}}" name="id">

  <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Start %</label>
                                                <input required="" name="start" id="start" value="{{$delivery->start}}" type="number" class="form-control">
                                                @if ($errors->has('start'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('start') }}
                                                </span>
                                            @endif
                                            </div>
                                        </div>
										
										
										
										
										<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">End %</label>
                                                <input required="" name="end" id="end" value="{{$delivery->end}}" type="number" class="form-control">
                                                @if ($errors->has('end'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('end') }}
                                                </span>
                                            @endif
                                            </div>
                                        </div>
										
										
										
										<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="title">Delivery Days</label>
                                                <input required="" name="days" id="days" value="{{$delivery->days}}" type="number" class="form-control">
                                                @if ($errors->has('days'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('days') }}
                                                </span>
                                            @endif
                                            </div>
                                        </div>
   

