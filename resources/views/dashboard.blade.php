{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
  <style>   
    :root {
      --avocado-green: #4B5320;
      --harvest-gold: #DAA520;
      --burnt-orange: #CC5500;
      --earth-brown: #3E2723;
      --cream-paper: #F5F5DC;
      --trippy-pink: #D81B60;
    }

    .grain-overlay {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      pointer-events: none;
      z-index: 9999;
      opacity: 0.04;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
    }

    body {
      background-color: var(--cream-paper);
      color: var(--earth-brown);
      font-family: "Arial Rounded MT Bold", "Helvetica Round", sans-serif;
    }

    h2, h3 {
      text-transform: uppercase;
      letter-spacing: -1px;
      color: var(--burnt-orange);
      text-shadow: 3px 3px 0px var(--harvest-gold), 6px 6px 0px var(--avocado-green);
      margin-bottom: 20px;
    }

    .modal-content h3 {
      text-shadow: 2px 2px 0px var(--harvest-gold);
      margin-bottom: 0;
    }

    .dashboard-container {
      background: #fff;
      border: 6px solid var(--earth-brown);
      border-radius: 40px 10px 40px 10px; 
      padding: 30px;
      box-shadow: 12px 12px 0px var(--trippy-pink);
      margin: 40px auto;
      max-width: 1100px;
    }


    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    thead th {
      background-color: var(--earth-brown);
      color: var(--harvest-gold);
      padding: 18px;
      font-size: 1.1rem;
      border-bottom: 4px solid var(--burnt-orange);
      text-align: left;
    }

    tbody tr:nth-child(even) { background-color: #FEF9E7; }
    tbody tr:nth-child(odd) { background-color: #FCF3CF; }

    tbody tr:hover {
      background-color: var(--harvest-gold) !important;
      color: white;
    }
    
    td {
      padding: 15px;
      border-bottom: 2px solid var(--earth-brown);
      font-weight: bold;
    }

    button {
      padding: 12px 25px;
      border-radius: 30px;
      border: 4px solid var(--earth-brown);
      font-weight: 900;
      text-transform: uppercase;
      box-shadow: 4px 4px 0px var(--earth-brown);
      cursor: pointer;
      transition: 0.1s;
    }

    button:active {
      transform: translate(2px, 2px);
      box-shadow: 1px 1px 0px var(--earth-brown);
    }

    .btn-add { background-color: var(--burnt-orange); color: white; }
    .btn-edit { background-color: var(--harvest-gold); color: white; padding: 8px 18px; font-size: 0.8rem; }
    .btn-delete { background-color: var(--burnt-orange); color: white; padding: 8px 18px; font-size: 0.8rem;}

    /* Modal Overlay */
    .modal-overlay {
      position: fixed;
      inset: 0;
      background: rgba(62, 39, 35, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 50;
    }

    .modal-content {
      background: var(--cream-paper);
      padding: 30px;
      border: 10px solid var(--avocado-green);
      border-radius: 20px;
      width: 100%;
      max-width: 500px;
      box-shadow: 15px 15px 0px var(--trippy-pink);
    }

    /* Input Styling */
    input, select {
      width: 100%;
      border: 3px solid var(--earth-brown);
      border-radius: 15px;
      padding: 12px;
      background-color: #FFF;
      font-weight: bold;
      margin-top: 5px;
    }
    
    .error-msg {
      color: var(--burnt-orange);
      font-weight: bold;
      font-size: 0.85rem;
      margin-top: 5px;
    }
  </style>

  <div class="grain-overlay"></div>

  <x-slot name="header">
    <h2 style="font-size: 2.5rem; text-align: center; margin-top: 20px;">Student Enrollment Records</h2>
  </x-slot>
   
  <div class="dashboard-container"
    x-data="{ 
        showAdd: {{ $errors->any() ? 'true' : 'false' }},  
        showEdit: false, 
        showDelete: false, showLogout: false, 
        selected: { id:null, student_id:'', name:'', 
                    course:'', year:'', block:'' }, 
        openEdit(e)   { this.selected = {...e}; this.showEdit = true; },
        openDelete(e) { this.selected = {...e}; this.showDelete = true; }
      }">

    @if (session('success'))
      <div style="background: var(--avocado-green); color: white; padding: 15px; border-radius: 15px; margin-bottom: 20px; font-weight: bold; border: 4px solid var(--earth-brown);">
        {{ session('success') }}
      </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center;">
      <h3>Total Enrollees: {{ $laravel_enrollees->count() }}</h3>
      <button class="btn-add" @click="showAdd = true; selected.block = '';">+ Add Enrollee</button>
    </div>

    <table>
      <thead>
        <tr>
          @foreach(['Student ID','Name','Course','Year','Block','Actions'] as $col)
            <th>{{ $col }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse ($laravel_enrollees as $i => $e)
        <tr>
          <td>{{ $e->student_id }}</td>
          <td>{{ $e->name }}</td>
          <td>{{ $e->course }}</td>
          <td>Year {{ $e->year }}</td>
          <td>{{ $e->block }}</td>
          <td>
            <div style="display: flex; gap: 10px;">
              <button class="btn-edit" @click="openEdit({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}', name:'{{ $e->name }}', course:'{{ $e->course }}', year:'{{ $e->year }}', block:'{{ $e->block }}' })">
                Edit
              </button>
              <button class="btn-delete" @click="openDelete({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}', name:'{{ $e->name }}' })">
                Delete
              </button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align: center; padding: 30px;">No enrollees found. Click "Add Enrollee" to get started!</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    {{-- ── ADD MODAL ─────────────────────────────────────────── --}}
    <div x-show="showAdd" class="modal-overlay" x-transition style="display:none">
      <div class="modal-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
          <h3>Add New Enrollee</h3>
          <button type="button" @click="showAdd=false" style="padding: 5px 15px; font-size: 20px; background: var(--earth-brown); color: white;">&times;</button>
        </div>
        
        <form method="POST" action="{{ route('enrollees.store') }}">
          @csrf
          
          {{-- Student ID --}}
          <div>
            <label>Student ID *</label>
            <input type="text" name="student_id" maxlength="9" placeholder="e.g. 202310626 (9 digits)" />
            @error('student_id') <p class="error-msg">{{ $message }}</p> @enderror
          </div>
          
          {{-- Name --}}
          <div style="margin-top: 15px;">
            <label>Full Name *</label>
            <input type="text" name="name" placeholder="e.g. Maria Santos" />
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror
          </div>
          
          {{-- Course --}}
          <div style="margin-top: 15px;">
            <label>Course *</label>
            <select name="course">
              <option value="">-- Select Course --</option>
              @foreach(['BSIT','BSCS','BSCS-EMC DAT','BSEMC-GD'] as $course)
                <option value="{{ $course }}">{{ $course }}</option>
              @endforeach
            </select>
            @error('course') <p class="error-msg">{{ $message }}</p> @enderror
          </div>
          
          {{-- Year --}}
          <div style="margin-top: 15px;">
            <label>Year Level *</label>
            <select name="year">
              <option value="">-- Select Year --</option>
              @foreach([1,2,3,4] as $yr)
                <option value="{{ $yr }}">Year {{ $yr }}</option>
              @endforeach
            </select>
            @error('year') <p class="error-msg">{{ $message }}</p> @enderror
          </div>
          
          {{-- Block --}}
          <div style="margin-top: 15px;">
            <label>Block *</label>
            <div style="display: flex; gap: 10px;">
              <select name="block_select" x-model="selected.block" style="flex: 1;">
                <option value="">-- A, B, C, D, E --</option>
                @foreach(['A','B','C','D','E'] as $blk)
                  <option value="{{ $blk }}">{{ $blk }}</option>
                @endforeach
              </select>
              <input type="text" name="block" x-model="selected.block" placeholder="Custom (A-Z)" 
                     @input="$event.target.value = $event.target.value.replace(/[^A-Z]/g,'').slice(0,5)" 
                     maxlength="5" style="flex: 1;" />
            </div>
            <small style="color: var(--earth-brown); font-weight: bold;">Dropdown OR custom block (capital letters only).</small>
            @error('block') <p class="error-msg">{{ $message }}</p> @enderror
          </div>
          
          <div style="margin-top: 25px; display: flex; gap: 15px; justify-content: flex-end;">
            <button type="button" @click="showAdd=false" style="background: var(--earth-brown); color: white;">Cancel</button>
            <button type="submit" style="background: var(--avocado-green); color: white;">Add Enrollee</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</x-app-layout>