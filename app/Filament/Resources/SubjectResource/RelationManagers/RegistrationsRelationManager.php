<?php

namespace App\Filament\Resources\SubjectResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('estudiante.nombre')->label('Nombre'),
                TextColumn::make('estudiante.apellido')->label('Apellido'),
                TextColumn::make('rating.calificacion')->label('Calificación'),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([])
            ->contentFooter(function () {
                $promedio = $this->getOwnerRecord()
                    ->registrations()
                    ->with('rating')
                    ->get()
                    ->pluck('rating.calificacion')
                    ->filter()
                    ->avg();

                return view('filament.promedio', [
                    'promedio' => $promedio ? round($promedio, 2) : 'Sin calificaciones'
                ]);
            });
    }
}
