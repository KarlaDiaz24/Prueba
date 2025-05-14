<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class RatingsRelationManager extends RelationManager
{
    protected static string $relationship = 'calificaciones';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inscripcion.materia.nombre')->label('Materia'),
                Tables\Columns\TextColumn::make('calificacion')->label('Calificación'),
                Tables\Columns\TextColumn::make('created_at')->date()->label('Fecha'),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([])
            ->contentFooter(function () {
                $promedio = $this->getOwnerRecord()
                    ->calificaciones()
                    ->pluck('calificacion')
                    ->filter()
                    ->avg();

                return view('filament.promedioS', [
                    'promedio' => $promedio ? round($promedio, 2) : 'Sin calificaciones'
                ]);
            });
    }
}
