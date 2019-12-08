@extends('layouts.nonapp')

@section('content')
<div>

  <div class="main-content">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2">

          <h2 class="tc mt4 fw4">永久免费，大会员享有更多功能</h2>

          <div class="br3 ba b--gray-monica bg-white mb4">
            <div class="pa4 bb b--gray-monica">

              <h3 class="tc">大会员享有哪些功能？</h3>
              <div class="cf mb4">
                <div class="{{ htmldir() == 'ltr' ? 'fl' : 'fr' }} w-50-ns w-100 pa3 mt0-ns mt4">
                  <div class="b--purple ba pt3 br3 bw1 relative">
                    <h3 class="tc mb3 pt3">免费用户</h3>
                    <ul class="mb4 center ph4">
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        <strong>永久免费</strong>
                      </li>
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        可添加最多 10 个常联系人
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="{{ htmldir() == 'ltr' ? 'fl' : 'fr' }} w-50-ns w-100 pa3">
                  <div class="b--gray-monica ba pt3 br3 bw1">
                    <h3 class="tc mb3 pt3">{{ trans('settings.subscriptions_plan_month_title') }}</h3>
                    <ul class="mb4 center ph4">
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        <strong>每月 6￥ （按年结算可优惠 20%）</strong>
                      </li>
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        无限添加联系人
                      </li>
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        导入联系人 vCard
                      </li>
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        常联系人* 自动邮件提醒
                      </li>
                      <li class="mb3 relative ml4">
                        <svg class="absolute" style="left: -30px; top: -3px;" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs></defs>
                          <g id="App" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Group-7">
                              <circle id="Oval-14" fill="#836BC8" cx="13" cy="13" r="13"></circle>
                              <polyline id="Path-16" stroke="#FFFFFF" stroke-width="2" points="6.95703125 13.2783203 11.5048828 17.7226562 21.0205078 7.75"></polyline>
                            </g>
                          </g>
                        </svg>
                        随时取消
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
