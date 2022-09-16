export default interface IPage<T> {
    currentPage: number;
    lastPage: number;
    nextPage: number;
    numResults: number;
    pageSize: number;
    previousPage: number;
    results: T[];
}