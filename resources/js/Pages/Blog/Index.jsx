import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage } from '@inertiajs/react';

export default function Index() {
    const { blogs } = usePage().props;
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Blogs
                </h2>
            }
        >
            <Head title="Blogs" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="flex justify-between">
                                <h1 className="text-2xl font-bold">Blogs</h1>
                                <a href="/blog/create" className="bg-blue-500 text-white px-4 py-2 rounded">Create Blog</a>
                            </div>
                            <table className="min-w-full mt-4">
                                <thead>
                                    <tr>
                                        <th className="px-4 py-2 border-b">Title</th>
                                        <th className="px-4 py-2 border-b">Content</th>
                                        <th className="px-4 py-2 border-b">Author</th>
                                        <th className="px-4 py-2 border-b">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {blogs.map((blog) => (
                                        <tr key={blog.id}>
                                            <td className="px-4 py-2 border-b">{blog.title}</td>
                                            <td className="px-4 py-2 border-b">{blog.content}</td>
                                            <td className="px-4 py-2 border-b">{blog.author}</td>
                                            <td className="px-4 py-2 border-b">
                                                <a href={`/blog/${blog.id}`} className="text-blue-500 mr-2">Edit</a>
                                                <a href={`/blog/delete/${blog.id}`} className="text-red-500">Delete</a>
                                            </td>
                                        </tr>
                                    ))}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>


    );
}
