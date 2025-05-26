import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import TextAreaInput from '@/Components/TextAreaInput';

export default function CreateBlogForm({ className = '' }) {
    const {
        data,
        setData,
        post,
        processing,
        errors,
        reset
    } = useForm({
        title: "",
        content: "",
    });

    function handleSubmit(e) {
        e.preventDefault();
        post('/blog/store', {
            onSuccess: () => reset(),
        });
    }

    return (
        <section className={className}>
            <form onSubmit={handleSubmit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="title" value="Title" />
                    <TextInput
                        id="title"
                        onChange={(e) => setData('title', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.title} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="content" value="Content" />
                    <TextAreaInput
                        id="content"
                        onChange={(e) => setData('content', e.target.value)}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.content} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                </div>
            </form>
        </section>
    );
}
