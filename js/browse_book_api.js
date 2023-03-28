// tags相關的 api
var tags_R_api = axios.create({
    baseURL: 'tags_R_api.php'
});
// 篩選小說相關的 api 01--依ID排序
var filter_Book_BYID_api = axios.create({
    baseURL: 'filter_Book_BYID_api.php'
});
// 篩選小說相關的 api 02--依更新時間排序
var filter_Book_BYUPD_api = axios.create({
    baseURL: 'filter_Book_BYUPD_api.php'
});
// 篩選小說相關的 api 03--依收藏排序
var filter_Book_BYCR_api = axios.create({
    baseURL: 'filter_Book_BYCR_api.php'
});


// tags相關的 api
const apiTagsItem = () => tags_R_api.get('/TagsItem');
// 篩選小說相關的 api 01--依ID排序
const apiFilter_Book_BYIDItem = () => filter_Book_BYID_api.get('/Filter_BookItem');
// 篩選小說相關的 api 02--依更新時間排序
const apiFilter_Book_BYUPDItem = () => filter_Book_BYUPD_api.get('/Filter_BookItem');
// 篩選小說相關的 api 03--依收藏排序
const apiFilter_Book_BYCRItem = () => filter_Book_BYCR_api.get('/Filter_BookItem');