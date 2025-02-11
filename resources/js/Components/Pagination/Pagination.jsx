import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/react/20/solid'
import {Link} from "@inertiajs/react";

export default function Pagination({paginationNumbers, currentPage, lastPage}) {
    let currentStyle = 'border-indigo-500 text-indigo-600'
    let defaultStyle = 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'


    return (
        <nav className="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
            <div className="-mt-px flex w-0 flex-1">
                {currentPage === 1 ?
                <p
                    className="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500"
                >
                    <ArrowLongLeftIcon aria-hidden="true" className="mr-3 size-5 text-gray-400" />
                    Previous
                </p>
            :
                <Link
                    href={`?page=${currentPage-1}`}
                    className="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                >
                    <ArrowLongLeftIcon aria-hidden="true" className="mr-3 size-5 text-gray-400" />
                    Previous
                </Link>}
            </div>
            <div className="hidden md:-mt-px md:flex">
                {paginationNumbers.map((pageNumber, i) => {
                    if(pageNumber ==='...'){
                        return (
                            <span key={'...'} className="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500">
                                ...
                            </span>)
                    }
                    return (
                    <Link
                        key={i}
                        href={`?page=${pageNumber}`}
                        className={`inline-flex items-center border-t-2 px-4 pt-4 text-sm font-medium ${currentPage === pageNumber ? currentStyle : defaultStyle}`}
                    >
                        {pageNumber}
                    </Link>
                )})}
            </div>
            <div className="-mt-px flex w-0 flex-1 justify-end">
                {currentPage === lastPage ?
                    <p
                        className="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500"
                    >
                        <ArrowLongRightIcon aria-hidden="true" className="mr-3 size-5 text-gray-400" />
                        Next
                    </p>
                    :
                    <Link
                        href={`?page=${currentPage+1}`}
                        className="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                    >
                        Next
                        <ArrowLongRightIcon aria-hidden="true" className="ml-3 size-5 text-gray-400" />
                    </Link>}

            </div>
        </nav>
    )
}
