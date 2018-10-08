export const SALE_ACTIVE    = 1;
export const SALE_CLOSED    = 2;
export const SALE_MARKUP    = 3;

export const BID_RESPONSE_MATCHED    = 1;
export const BID_RESPONSE_UNMATCHED  = 2;
export const BID_RESPONSE_SETTLED    = 3;
export const BID_RESPONSE_CANCELED   = 4;
export const BIDS_TYPES = ['matched','unmatched','settled','canceled'];

export const LOGIN_URL = '/login';
export const REGISTER_URL = '/register';
export const PROFILE_URL = '/login/userproftest';

//**BIDS**//
export const BIDS_INDEX = '/api/bids';


export const BID_RESPONSE_INDEX = '/api/bidResponse';

//**EVENTS**//
export const EVENTS_INDEX = '/api/events';
export const EVENT_SINGLE = '/api/events/';

//**SALE**//


export const SALE_MY        = '/sale/my';
export const SALE_MY_ACTIVE = '/sale/my/active';
export const SALE_MY_CLOSED = '/sale/my/closed';

export const SALE_INDEX     = '/api/sale';
export const SALE_CREATE    = '/api/sale';

//**SUBEVENTS**//
export const SUBEVENTS_INDEX = '/api/subevents';