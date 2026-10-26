<div class="lb-wrap">

    <style>
        /* ===== LOGBOOK LIST ===== */
        :root {
            --lb-primary: #3155e7;
            --lb-primary-dark: #2444c9;
            --lb-primary-light: #eef2ff;
            --lb-text: #111936;
            --lb-text-secondary: #64708a;
            --lb-border: #e5e7eb;
            --lb-radius: 14px;
            --lb-radius-sm: 10px;
            --lb-shadow-sm: 0 1px 3px rgba(15, 23, 42, .06);
            --lb-shadow-md: 0 4px 12px rgba(15, 23, 42, .08);
            --pagination-active-bg: #3155e7;
        }

        .lb-wrap {
            max-width: 860px;
            margin: 0 auto;
        }

        /* ===== HEADER ===== */
        .lb-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .lb-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: var(--lb-text);
            margin: 0 0 4px;
        }

        .lb-header p {
            font-size: 13px;
            color: var(--lb-text-secondary);
            margin: 0;
        }

        .lb-header-date {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            padding: 7px 12px;
            background: #fff;
            border: 1px solid var(--lb-border);
            border-radius: 99px;
            font-size: 12px;
            font-weight: 500;
            color: var(--lb-text-secondary);
            box-shadow: var(--lb-shadow-sm);
        }

        .lb-header-date i {
            color: var(--lb-primary);
            font-size: 14px;
        }

        /* ===== ATTENDANCE SUMMARY ===== */
        .lb-attendance {
            background: #fff;
            border: 1px solid var(--lb-border);
            border-radius: var(--lb-radius);
            box-shadow: var(--lb-shadow-sm);
            padding: 14px 16px;
            margin-bottom: 16px;
        }

        .lb-attendance-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .lb-attendance-head span:first-child {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            color: var(--lb-text);
        }

        .lb-attendance-head span:first-child i {
            color: var(--lb-primary);
            font-size: 15px;
        }

        .lb-attendance-month {
            font-size: 11px;
            font-weight: 600;
            color: var(--lb-text-secondary);
            background: var(--lb-primary-light);
            border-radius: 99px;
            padding: 4px 10px;
            white-space: nowrap;
        }

        .lb-attendance-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .lb-att-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border: 1px solid var(--lb-border);
            border-radius: var(--lb-radius-sm);
            background: #f8fafc;
        }

        .lb-att-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            flex-shrink: 0;
            font-size: 16px;
        }

        .lb-att-card strong {
            display: block;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.1;
            color: var(--lb-text);
        }

        .lb-att-card span.lb-att-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--lb-text-secondary);
        }

        .lb-att-card.is-hadir .lb-att-icon { background: #ecfdf5; color: #16a34a; }
        .lb-att-card.is-sakit .lb-att-icon { background: #fffbeb; color: #b45309; }
        .lb-att-card.is-izin  .lb-att-icon { background: #eef2ff; color: #4338ca; }
        .lb-att-card.is-sakit { background: #fffdf7; }
        .lb-att-card.is-izin  { background: #f8f9ff; }
        .lb-att-card.is-hadir { background: #f6fdfa; }

        /* ===== BADGES ===== */
        .lb-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 9px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            flex-shrink: 0;
        }

        /* ===== BUTTONS ===== */
        .lb-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: var(--lb-radius-sm);
            background: var(--lb-primary);
            color: #fff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .2s ease;
        }

        .lb-btn-primary:hover {
            background: var(--lb-primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--lb-shadow-md);
        }

        .lb-btn-primary i {
            font-size: 15px;
        }

        /* ===== FILTER BAR ===== */
        .lb-filter {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            background: #fff;
            border: 1px solid var(--lb-border);
            border-radius: var(--lb-radius-sm);
            padding: 12px 14px;
            box-shadow: var(--lb-shadow-sm);
            margin-bottom: 16px;
        }

        .lb-select-wrap {
            position: relative;
        }

        .lb-select {
            appearance: none;
            padding: 8px 32px 8px 12px;
            border: 1px solid var(--lb-border);
            border-radius: 8px;
            background: #fff;
            font-family: inherit;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--lb-text);
            cursor: pointer;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .lb-select:focus {
            outline: none;
            border-color: #c7d2fe;
            box-shadow: 0 0 0 3px rgba(49, 85, 231, .12);
        }

        .lb-select-wrap i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: var(--lb-text-secondary);
            pointer-events: none;
        }

        .lb-filter-count {
            font-size: 12px;
            color: var(--lb-text-secondary);
        }

        .lb-filter-count strong {
            color: var(--lb-primary);
        }

        /* ===== LIST ===== */
        .lb-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .lb-card {
            background: #fff;
            border: 1px solid var(--lb-border);
            border-left: 4px solid #d0d7e2;
            border-radius: var(--lb-radius);
            box-shadow: var(--lb-shadow-sm);
            overflow: hidden;
            transition: box-shadow .2s ease, transform .2s ease, border-color .2s ease;
        }

        .lb-card:hover {
            box-shadow: var(--lb-shadow-md);
        }

        .lb-card.status-submitted { border-left-color: #f59e0b; }
        .lb-card.status-approved { border-left-color: #34c17b; }
        .lb-card.status-revision_requested { border-left-color: #ef4444; }

        .lb-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            padding: 18px 20px 4px;
        }

        .lb-card-date {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            color: var(--lb-text);
        }

        .lb-card-date i {
            color: var(--lb-primary);
            font-size: 16px;
        }

        .lb-card-body {
            padding: 8px 20px 18px;
        }

        .lb-row {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .lb-row-label {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-shrink: 0;
            min-width: 92px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #98a2b3;
            padding-top: 2px;
        }

        .lb-row-label i {
            font-size: 13px;
        }

        .lb-row-text {
            flex: 1;
            min-width: 0;
            font-size: 13px;
            color: var(--lb-text-secondary);
            line-height: 1.55;
        }

        .lb-notes {
            margin-top: 14px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: var(--lb-radius-sm);
            padding: 12px 14px;
        }

        .lb-notes strong {
            display: block;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #92400e;
            margin-bottom: 4px;
        }

        .lb-notes p {
            margin: 0;
            font-size: 13px;
            line-height: 1.55;
            color: #78350f;
        }

        .lb-review {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 12px;
            font-size: 11px;
            color: #98a2b3;
        }

        .lb-review i {
            font-size: 12px;
        }

        /* ===== CARD FOOTER ===== */
        .lb-card-foot {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-top: 1px solid var(--lb-border);
            background: #fafbfe;
        }

        .lb-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all .15s ease;
        }

        .lb-btn i {
            font-size: 13px;
        }

        .lb-btn-send { background: #e9faf2; color: #0f8a52; }
        .lb-btn-send:hover { background: #d1fae5; }

        .lb-btn-edit { background: #fff; color: #475467; border-color: var(--lb-border); }
        .lb-btn-edit:hover { background: #f1f3f9; }

        .lb-btn-del { background: #fef2f2; color: #dc2626; margin-left: auto; }
        .lb-btn-del:hover { background: #fee2e2; }

        /* ===== EMPTY STATE ===== */
        .lb-empty {
            text-align: center;
            padding: 56px 24px;
            background: #fff;
            border: 1px solid var(--lb-border);
            border-radius: var(--lb-radius);
            box-shadow: var(--lb-shadow-sm);
        }

        .lb-empty-sub {
            font-size: 13px;
            color: var(--lb-text-secondary);
            margin: 12px 0 20px;
        }

        /* ===== PAGINATION ===== */
        .lb-wrap .pagination-wrap {
            justify-content: center;
            margin-top: 20px;
        }

        .lb-wrap .pagination-wrap .action-btn {
            border-color: var(--lb-border);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            .lb-header { flex-direction: column; }
            .lb-header-date { align-self: flex-start; }
            .lb-attendance-grid { grid-template-columns: 1fr; }
            .lb-card-top { flex-direction: column; }
            .lb-row { flex-direction: column; gap: 4px; }
            .lb-row-label { min-width: 0; }
            .lb-filter { align-items: stretch; flex-direction: column; }
            .lb-select { width: 100%; }
        }
    </style>

    {{-- HEADER --}}
    <div class="lb-header">
        <div>
            <h2>Logbook</h2>
            <p>
                Catatan kegiatan harian magang
                @if($hasActiveInternship && $logbooks->total() > 0)
                    · <strong style="color:var(--lb-primary)">{{ $logbooks->total() }}</strong> catatan
                @endif
            </p>
        </div>
        <span class="lb-header-date">
            <i class="ti ti-calendar"></i>
            {{ now()->translatedFormat('l, d M Y') }}
        </span>
    </div>

    {{-- ATTENDANCE SUMMARY --}}
    <div class="lb-attendance">
        <div class="lb-attendance-head">
            <span><i class="ti ti-shield-check"></i> Kehadiran Bulan Ini</span>
            <span class="lb-attendance-month">{{ now()->translatedFormat('F Y') }}</span>
        </div>
        <div class="lb-attendance-grid">
            <div class="lb-att-card is-hadir">
                <span class="lb-att-icon"><i class="ti ti-user-check"></i></span>
                <div>
                    <strong>{{ $attendanceSummary['hadir'] }}</strong>
                    <span class="lb-att-label">Hadir</span>
                </div>
            </div>
            <div class="lb-att-card is-sakit">
                <span class="lb-att-icon"><i class="ti ti-heart-rate-monitor"></i></span>
                <div>
                    <strong>{{ $attendanceSummary['sakit'] }}</strong>
                    <span class="lb-att-label">Sakit</span>
                </div>
            </div>
            <div class="lb-att-card is-izin">
                <span class="lb-att-icon"><i class="ti ti-user-off"></i></span>
                <div>
                    <strong>{{ $attendanceSummary['izin'] }}</strong>
                    <span class="lb-att-label">Izin</span>
                </div>
            </div>
        </div>
    </div>

    @if(!$hasActiveInternship)
        <div class="lb-empty">
            <x-empty-state icon="ti-notebook" message="Anda belum memiliki magang aktif." />
            <p class="lb-empty-sub">Logbook hanya bisa diisi saat magang berlangsung.</p>
            <a href="{{ route('intern.vacancies') }}" wire:navigate class="lb-btn-primary">
                <i class="ti ti-briefcase"></i> Cari Lowongan
            </a>
        </div>
    @else

        {{-- FILTER --}}
        <div class="lb-filter">
            <div class="lb-select-wrap">
                <select wire:model.live="filterStatus" class="lb-select">
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="submitted">Terkirim</option>
                    <option value="approved">Disetujui</option>
                    <option value="revision_requested">Perlu Revisi</option>
                </select>
                <i class="ti ti-chevron-down"></i>
            </div>
            <a href="{{ route('intern.logbooks.create') }}" wire:navigate class="lb-btn-primary">
                <i class="ti ti-plus"></i> Logbook Baru
            </a>
        </div>

        {{-- LIST --}}
        <div class="lb-list">
            @forelse($logbooks as $logbook)
            <div class="lb-card status-{{ $logbook->validation_status }}">
                <div class="lb-card-top">
                    <span class="lb-card-date">
                        <i class="ti ti-calendar-event"></i>
                        {{ $logbook->activity_date?->isoFormat('dddd, D MMMM Y') ?? '—' }}
                    </span>
                    <div style="display:flex;gap:6px;align-items:center;">
                        @if($logbook->attendance_type === 'hadir')
                            <span class="lb-badge" style="background:#ecfdf5;color:#15803d;border:1px solid #a7f3d0;">
                                <i class="ti ti-user-check"></i> Hadir
                            </span>
                        @elseif($logbook->attendance_type === 'sakit')
                            <span class="lb-badge lb-badge-sakit" style="background:#fef3c7;color:#92400e;border:1px solid #fde68a;">
                                <i class="ti ti-heart-rate-monitor"></i> Sakit
                            </span>
                        @elseif($logbook->attendance_type === 'izin')
                            <span class="lb-badge lb-badge-izin" style="background:#e0e7ff;color:#3730a3;border:1px solid #c7d2fe;">
                                <i class="ti ti-user-off"></i> Izin
                            </span>
                        @endif
                        <x-badge status="{{ $logbook->validation_status }}" />
                    </div>
                </div>

                <div class="lb-card-body">
                    <div class="lb-row">
                        <span class="lb-row-label"><i class="ti ti-tools"></i> Kegiatan</span>
                        <span class="lb-row-text">{{ Str::limit($logbook->activities, 200) }}</span>
                    </div>
                    <div class="lb-row">
                        <span class="lb-row-label"><i class="ti ti-package"></i> Output</span>
                        <span class="lb-row-text">{{ Str::limit($logbook->output, 120) }}</span>
                    </div>

                    @if($logbook->supervisor_notes)
                        <div class="lb-notes">
                            <strong>Catatan Pembimbing</strong>
                            <p>{{ $logbook->supervisor_notes }}</p>
                        </div>
                    @endif

                    @if($logbook->reviewed_at)
                        <span class="lb-review">
                            <i class="ti ti-eye"></i> Direview {{ $logbook->reviewed_at->diffForHumans() }}
                        </span>
                    @endif
                </div>

                @if($logbook->validation_status === 'draft')
                <div class="lb-card-foot">
                    <button
                        @click="window.dispatchEvent(new CustomEvent('confirm', { detail: { message: 'Kirim logbook ini ke supervisor?', callback: () => $wire.submit('{{ $logbook->id }}') } }))"
                        class="lb-btn lb-btn-send"
                    >
                        <i class="ti ti-send"></i> Kirim
                    </button>
                    <a href="{{ route('intern.logbooks.edit', $logbook->id) }}" wire:navigate class="lb-btn lb-btn-edit">
                        <i class="ti ti-pencil"></i> Edit
                    </a>
                    <button
                        @click="window.dispatchEvent(new CustomEvent('confirm', { detail: { message: 'Hapus logbook ini?', callback: () => $wire.delete('{{ $logbook->id }}') } }))"
                        class="lb-btn lb-btn-del"
                    >
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
                @endif
            </div>
            @empty
            <div class="lb-empty">
                <x-empty-state icon="ti-notebook" message="Belum ada logbook." />
                <p class="lb-empty-sub">Mulai catat kegiatan harian kamu sekarang.</p>
                <a href="{{ route('intern.logbooks.create') }}" wire:navigate class="lb-btn-primary">
                    <i class="ti ti-plus"></i> Buat Logbook Baru
                </a>
            </div>
            @endforelse
        </div>

        <div class="pagination-wrap">
            {{ $logbooks->links('components.pagination', ['paginator' => $logbooks]) }}
        </div>

    @endif

</div>