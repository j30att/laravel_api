export const SALE_ACTIVE    = 1;
export const SALE_CLOSED    = 2;
export const SALE_MARKUP    = 3;

export const BID_NEW        = 1;
export const BID_MATCHED    = 2;
export const BID_UNMATCHED  = 3;
export const BID_SETTLED    = 4;
export const BID_CANCELED   = 5;

export const LOGIN_URL = '/login';
export const REGISTER_URL = '/register';
export const PROFILE_URL = '/login/userproftest';

//**BIDS**//
export const BIDS_INDEX = '/api/bids';
export const BIDS_MY             = '/api/bids/my';
export const BIDS_MY_MATCHED     = '/api/bids/my/matched';
export const BIDS_MY_UNMATCHED   = '/api/bids/my/unmatched';
export const BIDS_MY_SETTLED     = '/api/bids/my/settled';
export const BIDS_MY_CANCELED    = '/api/bids/my/canceled';
export const BIDS_MY_STORE       = '/api/bids/my/store';


//**EVENTS**//
export const EVENTS_API = '/api/events';
export const SUB_EVENTS_API = '/api/subevents';

//**SALE**//

export const SALE_API       = '/api/sales';
export const SALE_MY        = '/api/sales/my';
export const SALE_MY_ACTIVE = '/api/sales/my/active';
export const SALE_MY_CLOSED = '/api/sales/my/closed';

export const SALE_CLOSING   ='/api/sales/closing';
export const SALE_CLOSING_SOON   ='/api/sales/closing-soon';
export const SALE_LOWEST    ='/api/sales/lowest';
export const SALE_SUBEVENT  ='/api/sales/subevent';

export const SALE_INDEX     = '/api/sale';
export const SALE_CREATE    = '/api/sale';

//**SUBEVENTS**//
export const SUBEVENTS_INDEX = '/api/subevents';

//**DEALER**//
export const DEALER_EVENTS_URL = '/api/dealer/events';
export const DEALER_USERS_URL = 'api/dealer/users';
export const DEALER_EVENTS_DETAIL_URL = '/api/dealer/event/detail';