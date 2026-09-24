<x-weight title="เพิ่มข้อมูลน้ำหนัก">

    <h2 class="mb-4">เพิ่มข้อมูลน้ำหนัก</h2>

    <form action="{{ route('weight.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">วันที่</label>

            <input
                type="date"
                class="form-control"
                id="date"
                name="date"
                value="{{ old('date') }}"
            >

            @error('date')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">น้ำหนัก (กิโลกรัม)</label>

            <input
                type="number"
                class="form-control"
                id="weight"
                name="weight"
                step="0.01"
                value="{{ old('weight') }}"
                placeholder="เช่น 65.50"
            >

            @error('weight')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            บันทึกน้ำหนัก
        </button>

        <a href="{{ route('weight.index') }}" class="btn btn-secondary">
            ยกเลิก
        </a>

    </form>

</x-weight>