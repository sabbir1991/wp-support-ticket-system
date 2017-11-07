<template>
    <div>
        <h1 class="wp-heading-inline">Plugins</h1>
        <a href="#" class="page-title-action">Add New</a>
        <hr class="wp-header-end">

        <div class="content table-responsive table-full-width" style="margin-top: 20px;">
            <div class="tablenav top">
                <div class="alignleft actions bulkactions">
                    <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                    <select name="action">
                        <option value="-1">Bulk Actions</option>
                        <option value="delete">Delete Forms</option>
                    </select>

                    <button class="button action">Apply</button>
                </div>

                <div class="tablenav-pages">

                    <span class="displaying-num">10 items</span>

                    <span class="pagination-links">
                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">«</span> -->
                        <a class="first-page" href="#"><span class="screen-reader-text">First page</span><span aria-hidden="true">«</span></a>

                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">‹</span> -->
                        <a class="prev-page" href="#"><span class="screen-reader-text"></span><span aria-hidden="true">‹</span></a>

                        <span class="screen-reader-text">Current Page</span><input class="current-page" id="current-page-selector" type="text" value="1" size="1" aria-describedby="table-paging"> of <span class="total-pages">10</span>

                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">›</span> -->
                        <a class="next-page" href="#"><span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span></a>

                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">»</span> -->
                        <a class="last-page" href="#"><span class="screen-reader-text">Last page</span><span aria-hidden="true">»</span></a>
                    </span>
                </div>
            </div>

            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                    <tr>
                        <td id="cb" class="manage-column column-cb check-column">
                            <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                            <input type="checkbox">
                        </td>
                        <th scope="col" class="col-form-name">Name</th>
                        <th scope="col" class="col-form-shortcode">Shortcode</th>
                        <th scope="col" class="col-form-entries">Entries</th>
                        <th scope="col" class="col-form-views">Views</th>
                        <th scope="col" class="col-form-conversion">Conversion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="check-column">
                            <input type="checkbox" name="post[]">
                        </th>
                        <td class="title column-title has-row-actions column-primary page-title">
                            <strong>Test Data</strong>

                            <div class="row-actions">
                                <span class="edit"><a href="#">Edit</a> | </span>
                                <span class="trash"><a href="#" class="submitdelete">Delete</a></span>
                            </div>
                        </td>
                        <td>Code data</td>
                        <td>
                            30
                        </td>
                        <td>Test view</td>
                        <td>
                            40
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td id="cb" class="manage-column column-cb check-column">
                            <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                            <input type="checkbox">
                        </td>
                        <th scope="col" class="col-form-name">Name</th>
                        <th scope="col" class="col-form-shortcode">Shortcode</th>
                        <th scope="col" class="col-form-entries">Entries</th>
                        <th scope="col" class="col-form-views">Views</th>
                        <th scope="col" class="col-form-conversion">Conversion</th>
                    </tr>
                </tfoot>
            </table>

            <div class="tablenav bottom">
                <div class="alignleft actions bulkactions">
                    <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                    <select name="action">
                        <option value="-1">Bulk Actions</option>
                        <option value="delete">Delete Forms</option>
                    </select>

                    <button class="button action">Apply</button>
                </div>

                <div class="tablenav-pages">

                    <span class="displaying-num">10 items</span>

                    <span class="pagination-links">
                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">«</span> -->
                        <a class="first-page" href="#" ><span class="screen-reader-text">First page</span><span aria-hidden="true">«</span></a>

                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">‹</span> -->
                        <a class="prev-page" href="#"><span class="screen-reader-text">Previous page</span><span aria-hidden="true">‹</span></a>

                        <span class="screen-reader-text">Current Page</span><input class="current-page" id="current-page-selector" type="text" value="1" size="1" aria-describedby="table-paging"> of <span class="total-pages">10</span>

                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">›</span> -->
                        <a class="next-page" href="#"><span class="screen-reader-text">Next page</span><span aria-hidden="true">›</span></a>

                        <!-- <span class="tablenav-pages-navspan" aria-hidden="true">»</span> -->
                        <a class="last-page" href="#"><span class="screen-reader-text">Last page</span><span aria-hidden="true">»</span></a>
                    </span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                message : 'Thisi s a simple'
            }
        }
    }

</script>