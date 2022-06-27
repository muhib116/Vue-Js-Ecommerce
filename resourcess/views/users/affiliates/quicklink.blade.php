<div style="margin-bottom: 10px;">
    <span>Quick Links</span>
    <a class="btn btn-danger" style="margin: 5px 3px;background: #ff6a00" href="{{route('agent.affiliateProducts')}}">Affiliate Products</a>
    <a class="btn btn-danger" style="margin: 5px 3px;background: #ff6a00" href="{{route('agent.myAffiliateProducts')}}">My Affiliate Products</a>
    <a class="btn btn-danger" style="margin: 5px 3px;background: #ff6a00" href="{{route('agent.affiliateOrders')}}">Sales Reports</a>
    <a class="btn btn-danger" style="margin: 5px 3px;background: #ff6a00" href="{{route('agent.affiliateTransactions')}}">Transactions History</a>
    <a class="btn btn-danger" style="margin: 5px 3px;background: #ff6a00" href="{{route('affiliateSoreProducts', Auth::user()->affiliateAgent->referral_code)}}">Visit Your Store</a>
</div>