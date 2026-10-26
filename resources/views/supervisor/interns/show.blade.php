@extends('layouts.app')
@section('title', 'Detail Peserta')
@php $pageTitle = 'Detail Peserta'; @endphp

@section('content')
<style>
    .sid-root {
        --sid-primary: #3155e7;
        --sid-primary-dark: #2444c9;
        --sid-primary-light: #eef2ff;
        --sid-text: #111936;
        --sid-muted: #64708a;
        --sid-border: #e5e7eb;
        --sid-green: #16a34a;
        --sid-green-bg: #ecfdf5;
        --sid-red: #dc2626;
        --sid-red-bg: #fef2f2;
    }

    /* ═══ HEADER ═══ */
    .sid-header {
        margin-bottom: 20px;
    }
    .sid-title {
        font-size: 22px;
        font-weight: 800;
        color: var(--sid-text);
        margin: 2px 0 4px;
        line-height: 1.3;
    }
    .sid-sub {
        font-size: 13px;
        color: var(--sid-muted);
        margin: 0;
    }

    /* ═══ IDENTITY CARD ═══ */
    .sid-identity {
        display: flex;
        align-items: center;
        gap: 15px;
        background: linear-gradient(135deg, #3155e7, #2444c9);
        border-radius: 14px;
        padding: 22px 24px;
        margin-bottom: 20px;
    }
    .sid-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .18);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        font-weight: 800;
        flex-shrink: 0;
        overflow: hidden;
    }
    .sid-identity-name {
        font-size: 17px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 3px;
        line-height: 1.3;
    }
    .sid-identity-mail {
        font-size: 12px;
        color: rgba(255, 255, 255, .82);
        margin: 0;
    }
    .sid-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
        background: rgba(255, 255, 255, .2);
        color: #fff;
        margin-left: auto;
        flex-shrink: 0;
    }

    /* ═══ LAYOUT ═══ */
    .sid-grid {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 16px;
        align-items: start;
    }
    .sid-card {
        background: #fff;
        border: 1px solid var(--sid-border);
        border-radius: 14px;
        padding: 22px 24px;
    }
    .sid-card-head {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 16px;
    }
    .sid-card-title {
        font-size: 14px;
        font-weight: 800;
        color: var(--sid-text);
        margin: 0;
    }
    .sid-card-title i {
        font-size: 17px;
        color: var(--sid-primary);
    }

    /* ═══ INFO ROWS ═══ */
    .sid-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        padding: 11px 0;
        border-bottom: 1px solid var(--sid-border);
    }
    .sid-row:last-of-type { border-bottom: none; }
    .sid-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: var(--sid-muted);
        flex-shrink: 0;
    }
    .sid-label i { font-size: 14px; }
    .sid-value {
        font-size: 13px;
        color: var(--sid-text);
        text-align: right;
        min-width: 0;
        overflow-wrap: anywhere;
    }

    .sid-skills {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 6px;
    }
    .sid-skill {
        padding: 5px 11px;
        border-radius: 99px;
        font-size: 11px;
        font-weight: 700;
        background: var(--sid-primary-light);
        color: var(--sid-primary);
    }

    .sid-progress {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 130px;
    }
    .sid-track {
        flex: 1;
        height: 8px;
        border-radius: 99px;
        background: #eef2f7;
        overflow: hidden;
    }
    .sid-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, #3155e7, #4f6ef5);
        transition: width .4s ease;
    }
    .sid-count {
        font-size: 12px;
        font-weight: 700;
        color: var(--sid-muted);
        white-space: nowrap;
    }

    /* ═══ SIDEBAR ═══ */
    .sid-actions {
        position: sticky;
        top: 8px;
        z-index: 1;
    }
    .sid-actions .sid-card { padding: 18px; }
    .sid-actions .sid-card-head { margin-bottom: 14px; }
    .sid-actions-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .sid-actions .sid-btn {
        width: 100%;
        min-height: 42px;
    }
    .sid-divider {
        height: 1px;
        background: var(--sid-border);
        margin: 14px 0 10px;
    }
    .sid-actions .sid-back {
        justify-content: center;
        width: 100%;
        padding: 8px 0;
    }
    .sid-btn:focus-visible,
    .sid-back:focus-visible {
        outline: 2px solid var(--sid-primary);
        outline-offset: 2px;
    }
    .sid-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 700;
        font-family: inherit;
        border-radius: 10px;
        cursor: pointer;
        text-decoration: none;
        transition: background .15s ease, box-shadow .15s ease, transform .15s ease;
    }
    .sid-btn i { font-size: 16px; }
    .sid-btn-primary {
        background: linear-gradient(135deg, #3155e7, #2444c9);
        color: #fff;
        border: none;
        box-shadow: 0 4px 12px rgba(49, 85, 231, .28);
    }
    .sid-btn-primary:hover {
        box-shadow: 0 6px 18px rgba(49, 85, 231, .38);
        transform: translateY(-1px);
    }
    .sid-btn-outline {
        background: #fff;
        color: var(--sid-primary);
        border: 1px solid var(--sid-primary);
    }
    .sid-btn-outline:hover {
        background: var(--sid-primary-light);
    }
    .sid-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        font-weight: 700;
        color: var(--sid-muted);
        text-decoration: none;
        padding: 8px 2px;
    }
    .sid-back:hover { color: var(--sid-primary); }

    /* ═══ RESPONSIVE ═══ */
    @media (max-width: 860px) {
        .sid-grid { grid-template-columns: 1fr; }
        .sid-actions { position: static; }
    }
    @media (max-width: 520px) {
        .sid-identity { flex-wrap: wrap; }
        .sid-badge { margin-left: 0; }
        .sid-row { flex-direction: column; gap: 4px; }
        .sid-value { text-align: left; }
        .sid-skills { justify-content: flex-start; }
        .sid-card { padding: 18px 16px; }
    }
</style>

<div class="sid-root">

    {{-- ═══ HEADER ═══ --}}
    <div class="sid-header">
        <div class="breadcrumb">
            <a href="{{ route('supervisor.dashboard') }}" wire:navigate>Dashboard</a>
            <i class="ti ti-chevron-right"></i>
            <a href="{{ route('supervisor.interns.index') }}" wire:navigate>Peserta Bimbingan</a>
            <i class="ti ti-chevron-right"></i>
            <span>Detail</span>
        </div>
        <h2 class="sid-title">Detail Peserta</h2>
        <p class="sid-sub">{{ $internship->intern->internProfile->full_name ?? $internship->intern->email }}</p>
    </div>

    {{-- ═══ IDENTITY ═══ --}}
    @php $name = $internship->intern->internProfile->full_name ?? $internship->intern->email ?? '—'; @endphp
    <div class="sid-identity">
        <div class="sid-avatar">{{ strtoupper(substr($name, 0, 1)) }}</div>
        <div>
            <p class="sid-identity-name">{{ $name }}</p>
            <p class="sid-identity-mail">{{ $internship->intern->email }}</p>
        </div>
        <span class="sid-badge">
            {{ $internship->status === 'active' ? 'Aktif' : ($internship->status === 'completed' ? 'Selesai' : 'Terminasi') }}
        </span>
    </div>

    {{-- ═══ BODY ═══ --}}
    <div class="sid-grid">
        <div class="sid-card">
            <div class="sid-card-head">
                <h3 class="sid-card-title"><i class="ti ti-user-circle"></i> Informasi Peserta</h3>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-building"></i> Institusi</span>
                <span class="sid-value">{{ $internship->intern->internProfile->institution_name ?? '—' }}</span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-book-2"></i> Jurusan</span>
                <span class="sid-value">{{ $internship->intern->internProfile->major ?? '—' }}</span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-id-badge-2"></i> NIM</span>
                <span class="sid-value">{{ $internship->intern->internProfile->student_id ?? '—' }}</span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-briefcase"></i> Posisi</span>
                <span class="sid-value">{{ $internship->vacancy->title ?? '—' }}</span>
            </div>

            <div class="sid-row">
                @php $g = $internship->intern->internProfile->gender ?? null; @endphp
                <span class="sid-label"><i class="ti {{ $g === 'male' ? 'ti-gender-male' : ($g === 'female' ? 'ti-gender-female' : 'ti-user') }}"></i> Jenis Kelamin</span>
                <span class="sid-value">{{ $g === 'male' ? 'Laki-laki' : ($g === 'female' ? 'Perempuan' : '—') }}</span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-phone"></i> No. Telepon</span>
                <span class="sid-value">{{ $internship->intern->internProfile->phone ?? '—' }}</span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-tags"></i> Keahlian</span>
                <span class="sid-value">
                    @php $skills = $internship->intern->internProfile?->skills ?? collect(); @endphp
                    @if($skills->count())
                    <div class="sid-skills">
                        @forelse($skills as $skill)
                            <span class="sid-skill">{{ $skill->name }}</span>
                        @empty
                            —
                        @endforelse
                    </div>
                    @else
                        —
                    @endif
                </span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-calendar"></i> Periode</span>
                <span class="sid-value">{{ $internship->actual_start_date?->format('d M Y') ?? '—' }} — {{ $internship->actual_end_date?->format('d M Y') ?? '—' }}</span>
            </div>

            <div class="sid-row">
                <span class="sid-label"><i class="ti ti-notebook"></i> Progress Logbook</span>
                <span class="sid-value">
                    @php $lbTotal = $internship->logbooks_count ?? 0; $lbApproved = $internship->approved_logbooks_count ?? 0; $pct = $lbTotal > 0 ? round(($lbApproved / $lbTotal) * 100) : 0; @endphp
                    <div class="sid-progress">
                        <div class="sid-track"><div class="sid-fill" style="width:{{ $pct }}%"></div></div>
                        <span class="sid-count">{{ $lbTotal > 0 ? $lbApproved . '/' . $lbTotal : '—' }}</span>
                    </div>
                </span>
            </div>
        </div>

        <div class="sid-actions">
            <div class="sid-card">
                <div class="sid-card-head">
                    <h3 class="sid-card-title"><i class="ti ti-bolt"></i> Aksi</h3>
                </div>
                <div class="sid-actions-list">
                    <a href="{{ route('supervisor.logbooks', ['intern_id' => $internship->intern_id]) }}"
                       wire:navigate class="sid-btn sid-btn-outline">
                        <i class="ti ti-notebook"></i> Lihat Logbook
                    </a>
                    <a href="{{ route('supervisor.evaluations.show', $internship->id) }}"
                       wire:navigate class="sid-btn sid-btn-primary">
                        <i class="ti ti-star"></i> Beri Nilai
                    </a>
                </div>
                <div class="sid-divider"></div>
                <a href="{{ route('supervisor.interns.index') }}" wire:navigate class="sid-back">
                    <i class="ti ti-arrow-left"></i> Kembali ke daftar
                </a>
            </div>
        </div>
    </div>

</div>
@endsection