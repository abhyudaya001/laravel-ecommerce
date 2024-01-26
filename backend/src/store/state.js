export default {
  user: {
    token: sessionStorage.getItem('TOKEN'),
    data: {}
  },
  products: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  coupons: {
    data: [],
    loading: false,
    links: {},
    page: 1,
    limit: 10, // Set your initial limit for coupons
    from: 1,
    to: 10,
    total: 0,
  },
  users: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  customers: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null
  },
  countries: [],
  orders: {
    loading: false,
    data: [],
    links: [],
    from: null,
    to: null,
    page: 1,
    limit: null,
    total: null,
    pdfId: null,
  },
  toast: {
    show: false,
    message: '',
    delay: 5000
  },
  dateOptions: [
    {key: '1d', text: 'Last Day'},
    {key: '1k', text: 'Last Week'},
    {key: '2k', text: 'Last 2 Weeks'},
    {key: '1m', text: 'Last Month'},
    {key: '3m', text: 'Last 3 Months'},
    {key: '6m', text: 'Last 6 Months'},
    {key: 'all', text: 'All Time'},
  ]
}
