import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';
import EditBlogForm from './Partials/EditBlogForm';
export default function Edit() {
    const { blog } = usePage().props;
    console.log(blog);

    return (
        <AuthenticatedLayout
            header={
                <>
                    <div className="flex justify-between items-center mb-4">
                        <div className="w-1/2">
                            <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 w-1/2">
                                Edit Blog
                            </h2>
                        </div>
                        <div className="w-1/2 text-right">
                            <a href="/blogs" className="bg-blue-500 text-white px-4 py-2 rounded">All Blogs</a>
                        </div>
                    </div>
                </>
            }
        >
            <Head title="Edit Blog" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                    <div className="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800">
                        <EditBlogForm blog={blog} className="max-w-xl" />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}